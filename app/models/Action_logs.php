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
    }