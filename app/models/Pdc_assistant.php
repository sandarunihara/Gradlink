<?php
class pdc_assistant
{
	
	use Model;

	protected $table = 'pdc_assistant';

	protected $allowedColumns = [

		'AssistantId',	
		'Password',
		'Name',
		'Degree',
		'Email',
		'profile_picture',
		'cover_picture',
		'gender',
		'contact_number',
		'address',
		'dob',
		'block'
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

	public function findById($AssistantId)
	{
		$record = $this->where(['AssistantId' => $AssistantId], [] , '' , 'do_not_order');
		//show($record);
		if($record)
		{
			return $record[0];
		}
		return false;
	}

}