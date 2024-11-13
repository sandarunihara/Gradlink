<?php
class pdc_assistant
{
	
	use Model;

	protected $table = 'pdc_assistant';

	protected $allowedColumns = [

		'AssistantId',	
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