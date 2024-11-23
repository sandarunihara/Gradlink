<?php
    class student_skill
    {
        
        use Model;

        protected $table = 'student_skill';

        protected $allowedColumns = [

            'StudentId',
            'Skill',
        ];
    }