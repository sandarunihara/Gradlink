<?php

class AdminNotificationOverview {
    use Controller;

    public function dashboard() {

        $model = new Admin_notification;
        $data = $model->getAllPending();

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

    public function updateAndRedirect(){
        $model = new Admin_notification;
        show($_POST);
        $id = $_POST['notification_id'];
        $type = $_POST['type'];
        $type_id = $_POST['id'];

        $updatedData = $model->update($id, ['status' => 'Read'] , 'id');
        if($updatedData['status'] == 'success' && $updatedData){
            switch($type){
                case 'student':
                    header("Location:" . ROOT . "/PDC_admin/ViewStudent/show/" . $type_id);
                    exit;

                case 'advertisement':
                    header("Location:" . ROOT . "/PDC_admin/ViewAdvertisement/show" . $type_id);
                    exit;

                case 'company':
                    header("Location:" . ROOT . "/PDC_admin/ViewCompanyshow" . $type_id);
                    exit;
            }
        }
        else{
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }

    public function read(){
        $model = new Admin_notification;
        $data = $model->getAllRead();
        //show($notificationData);

        $this->view('PDC_admin/Notification/NotificationRead' , [
            'data' => $data,
            'activeTab' => 'Read'
        ]);
    }


}
