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


    public function markAsRead($id, $notifi_type ,$report_id ,$report_type)
    {
        // dd($id, $notifi_type, $report_id, $report_type);
        Notification::where('id', $id)->update(['is_read' => 1]);
        $this->loadData();
        if($notifi_type == 3 || $notifi_type == 4){
            return redirect(route(auth()->user()->role['role_name'] . '.report-edit-'.$report_type, $report_id));
        }
    }


    public function loadData()
    {
        $this->notifications = Notification::where('user_id', auth()->user()->id)->where('is_read', 0)->orderBy('created_at', 'desc')->get();
        $this->notificationCount = $this->notifications->count();
        
    }

    public function rendered(){
        $this->dispatch('refreshNotifications', $this->notificationCount);
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
