<?php
class Action_logs
{

    use Model;

    protected $table = 'action_logs';

    protected $allowedColumns = [
        'id',
        'actor_id',
        'actor_role',
        'target_id',
        'target_type',
        'action_type',
        'reason',
        'timestamp'
    ];


    public function findDetails($companyId, $actor_id)
    {
        $query = "SELECT * FROM $this->table WHERE target_id = :target_id AND actor_id = :actor_id";
        $params = [
            'target_id' => $companyId,
            'actor_id' => $actor_id
        ];
        $result = $this->query($query, $params);
        return $result;
    }

    public function findDetailsforcompany($advertisementId, $actionType)
    {
        $query = "SELECT * FROM $this->table 
              WHERE target_id = :target_id 
                AND target_type = 'advertisement' 
                AND action_type = :action_type 
              ORDER BY timestamp DESC 
              LIMIT 1";
        $params = [
            'target_id' => $advertisementId,
            'action_type' => $actionType
        ];
        
        $result = $this->query($query, $params);
        return $result;
    }

    public function findDetailsforblockcompany($companyid, $actionType)
    {
        $query = "SELECT * FROM $this->table 
              WHERE target_id = :target_id 
                AND target_type = 'company' 
                AND action_type = :action_type 
              ORDER BY timestamp DESC 
              LIMIT 1";
        $params = [
            'target_id' => $companyid,
            'action_type' => $actionType
        ];
        
        $result = $this->query($query, $params);
        return $result;
    }

    public function findActionOfAdv($advertisementId){
        $query = "SELECT * FROM $this->table
                  WHERE  target_type = 'advertisement' AND targer_id = :target_id;
                ";
        $params = ['target_id' => $advertisementId];
        $result = $this->query($query,$params);
        return $result;
    }
}
