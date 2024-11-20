<?php
class company
{
	
	use Model;

	protected $table = 'company';

	protected $allowedColumns = [

		'CompanyId',
		'Name',
		'ContactPerson',
		'ShortDesc',
		'Email',
		'ContactNum',
		'Website',
		'Linkedin',
		'No',
		'Lane',
		'City',
		'District',
		'profileimg',
		'coverimg',
		'password'
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