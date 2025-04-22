<?php

class StudentImport
{
    use Model;

    protected $table = 'student_import';

    protected $allowedColumns = [
        'StudentId',
        'Name',
        'DegreeName', 
        'Email',
        'NIC',
        'ContactNum',
        'Status',
        'created_at'
    ];
}
