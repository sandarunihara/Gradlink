<?php 
class interview_time_slot
{
	
	use Model;

	protected $table = 'interview_time_slot';

	protected $allowedColumns = [

        'InterviewId',
        'Date',
        'Time',
        'CompanyId',
        'StudentId',
	];
}