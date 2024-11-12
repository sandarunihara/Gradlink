<?php 
class student_password
{
	
	use Model;

	protected $table = 'student_password';

	protected $allowedColumns = [

		'StudentId',
		'Password',
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

