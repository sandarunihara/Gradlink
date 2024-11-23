<?php
    class techtalk_slot
    {
        
        use Model;

        protected $table = 'techtalk_slot';

        protected $allowedColumns = [

            'TechTalkId',
            'Date',
            'Time',
            'Venue',
            'CompanyId',
            'AssistanceId',
        ];
    }