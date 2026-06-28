<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssetCategoryRequest;
use App\Http\Requests\UpdateAssetCategoryRequest;
use App\Models\AssetCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AssetCategoryController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', AssetCategory::class);
        $assetCategories = AssetCategory::latest()->paginate(10);
        return view('asset-categories.index', compact('assetCategories'));
    }

    public function create(): View
    {
        $this->authorize('create', AssetCategory::class);
        return view('asset-categories.create');
    }

    public function store(StoreAssetCategoryRequest $request): RedirectResponse
    {
        $this->authorize('create', AssetCategory::class);
        AssetCategory::create($request->validated());
        return to_route('asset-categories.index')->with('success', 'Asset category created successfully.');
    }

    public function show(AssetCategory $assetCategory): View
    {
        $this->authorize('view', $assetCategory);
        return view('asset-categories.show', compact('assetCategory'));
    }

    public function edit(AssetCategory $assetCategory): View
    {
        $this->authorize('update', $assetCategory);
        return view('asset-categories.edit', compact('assetCategory'));
    }

    public function update(UpdateAssetCategoryRequest $request, AssetCategory $assetCategory): RedirectResponse
    {
        $this->authorize('update', $assetCategory);
        $assetCategory->update($request->validated());
        return to_route('asset-categories.index')->with('success', 'Asset category updated successfully.');
    }

    public function destroy(AssetCategory $assetCategory): RedirectResponse
    {
        $this->authorize('delete', $assetCategory);
        $assetCategory->delete();
        return to_route('asset-categories.index')->with('success', 'Asset category deleted successfully.');
    }
}
