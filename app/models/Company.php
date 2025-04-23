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
		'Status',
		'profileimg',
		'coverimg',
		'AssistantId',
		'block',
		'block_count',
		'last_blocked_at',
		'created_at',
	];

	public function validate($data)
	{
		$this->errors = [];

		if (empty($data['company_name'])) {
			$this->errors['company_name'] = "Company name is required";
		}
		if (empty($data['email'])) {
			$this->errors['email'] = "Email is required";
		}
		if (empty($data['contact_number'])) {
			$this->errors['contact_number'] = "Contact number is required";
		}
		if (empty($data['address_no'])) {
			$this->errors['address_no'] = "Address No is required";
		}
		if (empty($data['address_lane'])) {
			$this->errors['address_lane'] = "Address Lane is required";
		}
		if (empty($data['address_city'])) {
			$this->errors['address_city'] = "Address City is required";
		}
		if (empty($data['address_district'])) {
			$this->errors['address_district'] = "Address District is required";
		}
		if (empty($data['description'])) {
			$this->errors['description'] = "Description is required";
		}
		if (empty($data['website'])) {
			$this->errors['website'] = "Website is required";
		}
		if (empty($data['linkedin'])) {
			$this->errors['linkedin'] = "Linkedin is required";
		}
		if (empty($this->errors)) {
			return true;
		}
		// print_r($this->errors);
		return empty($this->errors);
		// return $this->errors;
	}

	public function validatePendingCompany($data)
	{
		$this->errors = [];

		if (empty($data['company_name'])) {
			$this->errors['company_name'] = "Company name is required";
		}
		if (empty($data['email'])) {
			$this->errors['email'] = "Email is required";
		}
		// if (empty($data['contact_number'])) {
		// 	$this->errors['contact_number'] = "Contact number is required";
		// }
		if (empty($data['contact_person'])) {
			$this->errors['contact_person'] = "Contact person is required";
		}

		if (empty($this->errors)) {
			return true;
		}
		print_r($this->errors);

		return false;
	}

	public function gethighestadid()
	{
		$query = "SELECT CompanyId FROM $this->table ORDER BY CompanyId DESC LIMIT 1";
		$result = $this->query($query);
		return $result ? $result[0]->CompanyId : null;
	}

	public function findAllOngoing(): array|bool
	{
		try {
			$query = "SELECT * FROM $this->table WHERE Status = :status AND block != 1";
			$result = $this->query($query, ['status' => 'Ongoing']);
			return $result;
		} catch (Exception $e) {
			error_log("Error fetching ongoing companies: " . $e->getMessage());
			return false;
		}
	}

	public function findById($data)
	{
		if (is_array($data)) {
			// Build query dynamically for associative array
			$keys = array_keys($data);
			$query = "SELECT * FROM $this->table WHERE ";

			foreach ($keys as $key) {
				$query .= $key . " = :" . $key . " AND ";
			}

			// Trim the trailing " AND"
			$query = rtrim($query, " AND");

			// Debug: Log the query and data
			error_log("Generated Query: " . $query);
			error_log("Data: " . print_r($data, true));

			// Execute the query with the provided data
			$result = $this->query($query, $data);
		} else {
			// Assume $data is a single value (like CompanyId)
			$query = "SELECT * FROM $this->table WHERE CompanyId = :CompanyId";

			// Debug: Log the query and data
			error_log("Generated Query: " . $query);
			error_log("Data: " . print_r(['CompanyId' => $data], true));

			$result = $this->query($query, ['CompanyId' => $data]);
		}

		return $result ? $result[0] : null;
	}

	public function findEmailById($companyId)
	{
		try {
			$query = "SELECT Email FROM $this->table WHERE CompanyId = :companyId";

			$result = $this->query($query, ['companyId' => $companyId]);

			return $result[0]->Email ?? null;
		} catch (Exception $e) {
			// Log the error for debugging purposes
			error_log("Error fetching email by company ID: " . $e->getMessage());
			return false;
		}
	}


	public function findAllPending(): array|bool
	{
		try {
			$query = "SELECT * FROM $this->table WHERE Status = :status AND block != 1";

			$result = $this->query($query, ['status' => 'Pending']);

			return $result;
		} catch (Exception $e) {
			error_log("Error fetching ongoing companies: " . $e->getMessage());
			return false;
		}
	}

	public function findAllBlocked(): array|bool{
		try{
			$query = "SELECT * FROM $this->table WHERE block = 1 AND Status = 'Blocked'";
			$result = $this->query($query);
			return $result;
		} catch (Exception $e) {
			error_log("Error fetching blocked companies: " . $e->getMessage());
			return false;
		}
	}

	public function getTotalCount(): mixed{
		try{
			$query = "SELECT COUNT(CompanyId) AS total FROM $this->table";
			$result = $this->query($query);
			return $result[0]->{'total'};
		}catch (Exception $e) {
			error_log("Error fetching total number of companies: " . $e->getMessage());
			return false;
		}
	}

	public function registeredCount(){
		$query = "SELECT COUNT(*) FROM $this->table WHERE Status != 'Ongoing' AND block = 0";
		$result = $this->query($query);
		return $result[0]->{'COUNT(*)'};
	}

	public function pendingCount(){
		$query = "SELECT COUNT(*) FROM $this->table WHERE Status = 'Pending' AND block = 0";
		$result = $this->query($query);
		return $result[0]->{'COUNT(*)'};
	}

	public function getWeeklyCompany($week = 5){
		$query = "SELECT YEAR(created_at) as year,
    			         WEEK(created_at, 1) as week,
                         COUNT(*) as count
				  FROM $this->table
				  WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL :week WEEK)
				  GROUP BY year, week
				  ORDER BY year DESC, week DESC;
		
		";
		$params = [':week' => $week];
		$result = $this->query($query, $params);
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}

	// public function findallwithCompany(){
	// 	try {
	// 		$query = "SELECT "
	// 	} catch (\Throwable $th) {
	// 		//throw $th;
	// 	}
	// }
}
