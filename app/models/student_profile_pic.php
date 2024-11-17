<?php
    class student_profile_pic{
        use Model;

        protected $table = 'student_profile_pic';
    
        protected $allowedColumns = [
    
            'StudentId',
            'ProfilePicName',
            'Status',
        ];
    }