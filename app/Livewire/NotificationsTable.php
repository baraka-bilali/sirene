<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Notification;

class NotificationsTable extends Component
{
    public $notifications;

    public function render()
    {
        // Dernières notifications (tu peux ajuster le nombre ou la pagination)
        $this->notifications = Notification::latest()->take(20)->get();

        return view('livewire.notifications-table');
    }
}
