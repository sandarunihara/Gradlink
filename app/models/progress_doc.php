<?php
    class progress_doc
    {
        
        use Model;

        protected $table = 'progress_doc';

        protected $allowedColumns = [

            'DocumentId',
            'SubmissionDate',
            'Status',
            'StudentId',
            'Name',
        ];
    }