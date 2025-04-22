<?php

class Admin_notification{

    use Model;

    protected $table = 'admin_notifications';

    protected $allowedColumns = [
        'id',
        'type',
        'company_id',
        'advertisement_id',
        'status',
        'created_at',
        'reason'
    ];

    public function findpending(){
        $query = "SELECT * FROM $this->table WHERE status = 'Pending'";
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

}