<?php

class AdminNotificationOverview {
    use Controller;

    public function dashboard() {

        $this->view('PDC_admin/Notification/NotificationOverview' , [
            'activeTab' => 'Pending',
            // 'notification' => 'Pending'
        ]);
    }
}
