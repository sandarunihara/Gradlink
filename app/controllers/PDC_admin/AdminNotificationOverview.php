<?php

class AdminNotificationOverview {
    use Controller;

    public function dashboard() {

        $model = new Admin_notification;
        $data = $model->findpendingwithCompany();

        //show($data);


        $this->view('PDC_admin/Notification/NotificationOverview' , [
            'activeTab' => 'Pending',
            'data' => $data
        ]);
    }

    public function approved(){
        $model = new Admin_notification;
        $data = $model->findapproved();

        //show($data);

        $this->view('PDC_admin/Notification/NotificationApproved' , [
            'activeTab' => 'Approved',
            'data' => $data
        ]);
    }

    public function rejected(){
        $model = new Admin_notification;
        $data = $model->findreject();

        //show($data);

        $this->view('PDC_admin/Notification/NotificationRejected' , [
            'activeTab' => 'Rejected',
            'data' => $data
        ]);
    }

    public function getNotificationCount(){
        $model = new Admin_notification;
        $data = $model->notificationCount();

        //show($data);

        echo json_encode($data);
    }


}
