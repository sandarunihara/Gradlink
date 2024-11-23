<?php
    class qualification
    {
        
        use Model;

        protected $table = 'qualification';

        protected $allowedColumns = [

            'QualificationId',
            'Degree',
            'StartDate',
            'EndDate',
            'FieldOfStudy',
            'ShortDesc',
            'StudentId',
        ];
    }