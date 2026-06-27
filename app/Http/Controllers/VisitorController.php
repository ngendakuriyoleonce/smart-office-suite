<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisitorRequest;
use App\Http\Requests\UpdateVisitorRequest;
use App\Models\Employee;
use App\Models\Visitor;
use App\Services\OpenAIService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class VisitorController extends Controller
{
    public function __construct(
        protected OpenAIService $openAI,
    ) {}

    public function index(): View
    {
        $visitors = Visitor::with('host')->latest()->paginate(10);
        return view('visitors.index', compact('visitors'));
    }

    public function create(): View
    {
        $employees = Employee::all();
        return view('visitors.create', compact('employees'));
    }

    public function store(StoreVisitorRequest $request): RedirectResponse
    {
        Visitor::create($request->validated());
        return to_route('visitors.index')->with('success', 'Visitor created successfully.');
    }

    public function show(Visitor $visitor): View
    {
        $visitor->load('host');
        $summary = null;
        if ($visitor->purpose) {
            try {
                $summary = $this->openAI->summarizeVisit($visitor->purpose);
            } catch (\Exception $e) {
                Log::warning('AI summarization failed: ' . $e->getMessage());
            }
        }
        return view('visitors.show', compact('visitor', 'summary'));
    }

    public function edit(Visitor $visitor): View
    {
        $employees = Employee::all();
        return view('visitors.edit', compact('visitor', 'employees'));
    }

    public function update(UpdateVisitorRequest $request, Visitor $visitor): RedirectResponse
    {
        $visitor->update($request->validated());
        return to_route('visitors.index')->with('success', 'Visitor updated successfully.');
    }

    public function destroy(Visitor $visitor): RedirectResponse
    {
        $visitor->delete();
        return to_route('visitors.index')->with('success', 'Visitor deleted successfully.');
    }

    public function checkIn(Visitor $visitor): RedirectResponse
    {
        $visitor->update(['check_in' => Carbon::now()]);

        try {
            $data = json_encode([
                'name' => $visitor->full_name,
                'company' => $visitor->company,
                'email' => $visitor->email,
                'check_in' => $visitor->check_in->toDateTimeString(),
                'host' => $visitor->host->full_name,
            ]);

            $filename = 'qrcodes/visitor-' . $visitor->id . '-' . now()->timestamp . '.svg';
            Storage::disk('public')->put($filename, QrCode::format('svg')->generate($data));

            $visitor->update(['badge_qr' => 'storage/' . $filename]);
        } catch (\Exception $e) {
            Log::warning('QR generation failed: ' . $e->getMessage());
        }

        return to_route('visitors.show', $visitor)->with('success', 'Visitor checked in successfully.');
    }

    public function checkOut(Visitor $visitor): RedirectResponse
    {
        $visitor->update(['check_out' => Carbon::now()]);

        return to_route('visitors.show', $visitor)->with('success', 'Visitor checked out successfully.');
    }
}
