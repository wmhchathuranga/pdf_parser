<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;

class Notifications extends Component
{

    public $notifications;
    public $notificationCount;

    public function mount()
    {
        $this->loadData();
    }


    public function markAllAsRead()
    {
        Notification::where('user_id', auth()->user()->id)
            ->whereIn('type', [1, 2])
            ->update(['is_read' => 1]);

        $this->loadData();
    }


    public function markAsRead($id)
    {
        Notification::where('id', $id)->update(['is_read' => 1]);
        $this->loadData();
    }


    public function loadData()
    {
        $this->notifications = Notification::where('user_id', auth()->user()->id)->where('is_read', 0)->orderBy('created_at', 'desc')->get();
        $this->notificationCount = $this->notifications->count();
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
