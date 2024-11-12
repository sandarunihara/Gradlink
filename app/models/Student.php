<?php
    class student
    {
        
        use Model;

        protected $table = 'student';

        protected $allowedColumns = [

            'StudentId',
            'Name',
            'DegreeName',
            'Status',
            'ShortDesc'
        ];
    }