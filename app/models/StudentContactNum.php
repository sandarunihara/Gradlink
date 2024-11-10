<?php
    class StudentContactNum
    {
        
        use Model;

        protected $table = 'studentcontactnum';

        protected $allowedColumns = [

            'ContactNum',
        ];
    }