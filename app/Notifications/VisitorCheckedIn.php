<?php

namespace App\Notifications;

use App\Models\Visitor;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class VisitorCheckedIn extends Notification
{
    use Queueable;

    public function __construct(
        public Visitor $visitor,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {

        return [
            'visitor_id' => $this->visitor->id,
            'message' => "{$this->visitor->full_name} has checked in.",
            'action_url' => route('visitors.show', $this->visitor),
        ];
    }
}
