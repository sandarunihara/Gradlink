<?php
    class complaint
    {
        
        use Model;

        protected $table = 'complaint';

        protected $allowedColumns = [

            'ComplaintId',
            'Topic',
            'Date',
            'Description',
            'Status',
            'CompanyId',
            'StudentId'
        ];
    }