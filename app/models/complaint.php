<?php
    class complaint
    {
        
        use Model;

        protected $table = 'complaint';

        protected $allowedColumns = [

            'ComplaintId',
            'Topic',
            'Description',
            'Status',
            'CompanyId',
            'StudentId',
            'CreatedAt',
        ];


    }