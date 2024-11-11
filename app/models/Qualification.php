<?php
    class Qualification  
    {
        
        use Model;

        protected $table = 'qualification ';

        protected $allowedColumns = [

            'Dgree',
            'StartDate',
            'EndDate',
            'FieldOfStudy',
            'ShortDesc'
        ];
    }