<?php
    class StudentEmail
    {
        
        use Model;

        protected $table = 'studentemail';

        protected $allowedColumns = [

            'Email',
        ];
    }