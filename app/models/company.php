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
		'No',
		'Lane',
		'City',
		'District',
		'Password',
		'Email',
		'ContactNum',
		'Website',
		'Linkedin',
		'AssistantId',
	];

	public function validate($data)
	{
		$this->errors = [];

		if (empty($data['name'])) {
			$this->errors['name'] = "Company name is required";
		}
		if (empty($data['contact'])) {
			$this->errors['password'] = "Password is required";
		}
		if (empty($this->errors)) {
			return true;
		}

		return false;
	}

	public function findall(): array|bool
	{
		$query = "SELECT * FROM company";
		$result = $this->query($query);
		return $result;
	}

	
}
