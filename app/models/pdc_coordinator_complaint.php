<?php
    class pdc_coordinator_complaint
    {
        
        use Model;

        protected $table = 'pdc_coordinator_complaint';

        protected $allowedColumns = [

            'CoordinatorId',
            'ComplaintId',
            'Reply',

        ];
    }