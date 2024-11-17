<?php 
class student
{
	
	use Model;

	protected $table = 'student';

	protected $allowedColumns = [

		'StudentId',
		'Password',
		'Name',
		'DegreeName',
		'Status',
		'ShortDesc',
		'Email',
		'ContactNum',
		'Github',
		'Linkedin',
	];
	
	public function validate($data)
	{
		$this->errors = [];

		if(empty($data['UserId']))
		{
			$this->errors['UserId'] = "id is required";
		}
		if(empty($data['password']))
		{
			$this->errors['password'] = "Password is required";
		}
	

		if(empty($this->errors))
		{
			return true;
		}

		return false;
	}
}

