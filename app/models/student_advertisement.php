<?php 
class student_advertisement
{
	
	use Model;

	protected $table = 'student_advertisement';

	protected $allowedColumns = [

		'Date',
		'StudentId',
        'AdvertisementId',
        'JobStatus',
	];
}