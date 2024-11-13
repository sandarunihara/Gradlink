<?php
    class complaint
    {
        
        use Model;

        protected $table = 'complaint';

        protected $allowedColumns = [

            'StudentId',
            'Topic',
            'Date',
            'Description',
            'Status',
        ];
    }