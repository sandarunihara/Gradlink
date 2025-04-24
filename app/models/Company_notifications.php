<?php

class Company_notifications{
    use Model; 
    protected $table = 'company_notifications';

    protected $allowedColumns = [
        'id',
        'actor_id',
        'target_id',
        'message',
        'read_status',
        'timestamp'
    ];

    
}