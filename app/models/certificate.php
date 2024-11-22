<?php
    class certificate
    {
        
        use Model;

        protected $table = 'certificate';

        protected $allowedColumns = [

            'CertificateId',
            'Name',
            'Organization',
            'IssueDate',
            'ExpirationDate',
            'ShortDesc',
            'CredentialUrl',
            'StudentId'
        ];
    }