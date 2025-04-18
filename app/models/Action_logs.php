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

    }