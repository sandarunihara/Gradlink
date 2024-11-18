<?php
    class experience
    {
        
        use Model;

        protected $table = 'experience';

        protected $allowedColumns = [

            'ExperienceId',
            'JobTitle',
            'Company',
            'Location',
            'EmploymentType',
            'StartDate',
            'EndDate',
            'ShortDesc',
            'StudentId',
        ];
    }