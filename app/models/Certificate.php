<?php
    class Certificate  
    {
        
        use Model;

        protected $table = 'certificate';

        protected $allowedColumns = [

            'Name',
            'Organization',
            'IssueDate',
            'ExpirationDate',
            'ShortDesc'
        ];
    }