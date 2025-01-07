<?php

class student_company
{
    use Model;

    protected $table = 'student_company';

    protected $allowedColumns = [
        'StudentId',
        'CompanyId',
        'StartDate',
        'EndDate',
    ];
}
