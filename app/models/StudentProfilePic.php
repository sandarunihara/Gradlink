<?php
    class StudentProfilePic  
    {
        
        use Model;

        protected $table = 'studentprofilepic ';

        protected $allowedColumns = [

            'ProfilePic',
        ];
    }