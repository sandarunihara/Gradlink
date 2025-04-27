<?php

class Admin_notification{

    use Model;

    protected $table = 'admin_notifications';

    protected $allowedColumns = [
        'id',
        'type',
        'company_id',
        'advertisement_id',
        'student_id',
        'status',
        'created_at',
        'reason'
    ];

    public function getAllPending(){
        $query = "SELECT * FROM $this->table WHERE status = 'Pending' AND type = 'coordinator_request' AND type = 'coordinator_request' ";
        $result = $this->query($query);
        return $result;
    }

    public function getAllRead(){
        $query = "SELECT * FROM $this->table WHERE status = 'Read'";
        $result = $this->query($query);
        return $result;
    }

    public function findpendingwithCompany(){
        $query = "SELECT n.* , c.* FROM $this->table n
                  JOIN company c ON n.company_id = c.CompanyId
                  WHERE n.status = 'Pending'";
        $result = $this->query($query);
        if(empty($result)){
            return false;
        }
        else{
            return $result;
        }
    }

    public function findapproved(){
        $query = "SELECT * FROM $this->table WHERE status = 'Approved'";
        $result = $this->query($query);
        if(empty($result)){
            return false;
        }
        else{
            return $result;
        }
    }
    
    public function findreject(){
        $query = "SELECT * FROM $this->table WHERE status = 'Rejected'";
        $result = $this->query($query);
        if(empty($result)){
            return false;
        }
        else{
            return $result;
        }
    }

    public function notificationCount(){
        $query = "SELECT COUNT(*) as count FROM $this->table WHERE status = 'Pending' AND type = 'deactivation_request' OR type = 'coordinator_request'";
        $result = $this->query($query);
        if(empty($result)){
            return false;
        }
        else{
            return $result[0]->count;
        }
    }

    public function findbyAdvertisementId($advertisementId){
        $query = "SELECT * FROM $this->table WHERE advertisement_id = :advertisement_id";
        $params = [':advertisement_id' => $advertisementId];
        $result = $this->query($query, $params);
        return $result ? $result[0] : false;
    }

    public function countAdv(){
        $query = "SELECT COUNT(*) as count FROM $this->table WHERE status = 'Pending' AND type = 'deactivation_request'";
        $result = $this->query($query);
        if(empty($result)){
            return false;
        }
        else{
            return $result[0]->count;
        }
    }

    public function countPdc(){
        $query = "SELECT COUNT(*) as count FROM $this->table WHERE status = 'Pending' AND type = 'coordinator_request'";
        $result = $this->query($query);
        if(empty($result)){
            return false;
        }
        else{
            return $result[0]->count;
        }
    }
}