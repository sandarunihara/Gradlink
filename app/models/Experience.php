<?php
    class Experience  
    {
        
        use Model;

        protected $table = 'experience ';

        protected $allowedColumns = [

            'JobTitle',
            'Company',
            'Location',
            'EmploymentType',
            'StartDate',
            'EndDate',
            'ShortDesc'
        ];
    }