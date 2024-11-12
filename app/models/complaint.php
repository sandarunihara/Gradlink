<?php
    class complaint
    {
        
        use Model;

        protected $table = 'complaint';

        protected $allowedColumns = [

            'Date',
            'Description',
        ];
    }