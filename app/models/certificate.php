<?php
    class certificate
    {
        
        use Model;

        protected $table = 'certificate';

        protected $allowedColumns = [
            'CretificateId',
            'Name',
            'Organization',
            'StudentId',
            'CredentialUrl',
        ];


    }