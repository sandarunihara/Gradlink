<?php 
class student_advertisement
{
	
	use Model;

	protected $table = 'studentadvertisement';

	protected $allowedColumns = [

		'Date',
		'StudentId',
        'AdvertisementId',
        'JobStatus',
	];
}