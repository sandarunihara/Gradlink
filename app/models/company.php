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

	public function findById($data): array|bool{
        // Check if $data is an associative array or a single value
		if(is_array(value: $data))
		{
			$keys = array_keys($data);
            $query = "SELECT * FROM company WHERE ";
        
            foreach ($keys as $key) {
                $query .= $key . " = :" . $key . " AND ";
            }
        
            $query = trim($query, "AND "); // Trim the trailing "AND"
            
            $result = $this->query($query, $data);
        } else {
            // Assume $data is a single ID (like CompanyId)
			$query = "SELECT * FROM company WHERE CompanyId = :CompanyId";
			$result = $this->query($query, ['CompanyId' => $data]);
		}

		return $result;
		
	}
}
