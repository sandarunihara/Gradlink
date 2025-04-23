<?php 
class student
{
	
	use Model;

	protected $table = 'student';

	protected $allowedColumns = [

		'StudentId',
		'Password',
		'Name',
		'NIC',
		'DegreeName',
		'Status',
		'ShortDesc',
		'Email',
		'ContactNum',
		'Github',
		'Linkedin',
		'ProfilePic',
		'cv',
		'block',
		'completed',
		'registered',
		'noOfAppliedAds',
		'block',
		'block_count',
		'last_blocked_at',
		'created_at'
	];

	public function validate($data , $ispartialData = false){
		$this->errors = []; // Clear errors each time validate is called

		if($ispartialData == false){
			if (empty($data['StudentId']) || !preg_match('/^\d{4}[a-zA-Z]{2}\d{3}$/', $data['StudentId'])) {
				$this->errors['StudentId'] = "Student ID must be in the format '2022cs021'.";
			}
			if (empty($data['NIC']) || !preg_match('/^(\d{9}[vVxX]|\d{12})$/', $data['NIC'])) {
				$this->errors['NIC'] = "NIC must be 9 digits followed by 'V' or 'X', or 12 digits.";
			}
			if (empty($data['Name'])) {
				$this->errors['Name'] = "Student Name is required.";
			}
			if (empty($data['Email']) || !filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
				$this->errors['Email'] = "Valid Email is required.";
			}
			if (empty($data['DegreeName']) || !in_array($data['DegreeName'], ['Computer Science', 'Information System'])) {
				$this->errors['DegreeName'] = "Please select a valid Degree Name.";
			}
			if (empty($data['Status']) || !in_array($data['Status'], ['Not Applied', 'Pending', 'Ongoing' , 'Rejected'])) {
				$this->errors['Status'] = "Please select a valid Status.";
			}
			if (empty($data['ContactNum']) || !preg_match('/^\+?\d{10,15}$/', $data['ContactNum'])) {
				$this->errors['ContactNum'] = "Contact number must be 10-15 digits and may start with '+'.";
			}
		}
		else{
			if (isset($data['StudentId']) && (!preg_match('/^\d{4}[a-zA-Z]{2}\d{3}$/', $data['StudentId']))) {
				$this->errors['StudentId'] = "Student ID must be in the format '2022cs021'.";
			}
			if (isset($data['NIC']) && (!preg_match('/^(\d{9}[vVxX]|\d{12})$/', $data['NIC']))) {
				$this->errors['NIC'] = "NIC must be 9 digits followed by 'V' or 'X', or 12 digits.";
			}
			if (isset($data['Name']) && empty($data['Name'])) {
				$this->errors['Name'] = "Student Name is required.";
			}
			if (isset($data['Email']) && (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL))) {
				$this->errors['Email'] = "Valid Email is required.";
			}
			if (isset($data['DegreeName']) && (!in_array($data['DegreeName'], ['Computer Science', 'Information System']))) {
				$this->errors['DegreeName'] = "Please select a valid Degree Name.";
			}
			if (isset($data['Status']) && (!in_array($data['Status'], ['Not Applied', 'Pending', 'Ongoing', 'Rejected']))) {
				$this->errors['Status'] = "Please select a valid Status.";
			}
			if (isset($data['ContactNum']) && (!preg_match('/^\+?\d{10,15}$/', $data['ContactNum']))) {
				$this->errors['ContactNum'] = "Contact number must be 10-15 digits and may start with '+'.";
			}
		}

		return empty($this->errors);
	}

	public function validating($data){
		$this->errors = [];

		if (!preg_match('/^\d{4}[a-zA-Z]{2}\d{3}$/', $data['StudentId'])) {
			$this->errors['StudentId'] = "Student ID must be in the format '2022cs021'.";
		}
		if (!preg_match('/^(\d{9}[vVxX]|\d{12})$/', $data['NIC'])) {
			$this->errors['NIC'] = "NIC must be 9 digits followed by 'V' or 'X', or 12 digits.";
		}
		if (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
			$this->errors['Email'] = "Valid Email is required.";
		}

		show($this->errors);

		if (empty($this->errors)) {
			return true;
		}
		return false;
	}


	public function validateRegisteredStudents($data){
		$this->errors = [];

		if (empty($data['StudentId']) || !preg_match('/^\d{4}[a-zA-Z]{2}\d{3}$/', $data['StudentId'])) {
			$this->errors['StudentId'] = "Student ID must be in the format '2022cs021'.";
		}
		if (empty($data['NIC']) || !preg_match('/^(\d{9}[vVxX]|\d{12})$/', $data['NIC'])) {
			$this->errors['NIC'] = "NIC must be 9 digits followed by 'V' or 'X', or 12 digits.";
		}
		if (empty($data['Name'])) {
			$this->errors['Name'] = "Student Name is required.";
		}
		if (empty($data['Email']) || !filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) {
			$this->errors['Email'] = "Valid Email is required.";
		}

		if (empty($this->errors)) {
			return true;
		}
		return false;
	}

	public function findregistered(){
		$query = "SELECT * FROM $this->table WHERE block = '0' AND registered = '1'";
		$result = $this->query($query);
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}
	
	
	
	public function findall()
    {
        $query = "SELECT * FROM $this->table";

        $result = $this->query($query);
        return $result;
		
    }

	public function findnotapplied(){
		$query = "SELECT * FROM $this->table WHERE Status = 'Not Applied' AND block = '0' AND registered = '1'";
		$result = $this->query($query);
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}

	public function findRecruited(){
		$query = "SELECT * FROM $this->table WHERE Status = 'Ongoing' AND block = '0' AND registered = '1'";
		$result = $this->query($query);
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}

	public function findRejected(){
		$query = "SELECT * FROM $this->table WHERE Status = 'Rejected' AND block = '0' AND registered = '1'";
		$result = $this->query($query);
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}

	public function findAllBlocked(){
		$query = "SELECT * FROM $this->table WHERE block = '1' AND Status = 'Blocked'";
		$result = $this->query($query);
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}


	public function findAllPending(){
		$query = "SELECT * FROM $this->table WHERE Status = 'Pending' AND block = 0 AND registered = '1'";
		$result = $this->query($query);
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}

	public function findNotReg(){
		$query = "SELECT * FROM $this->table WHERE block = '0' AND registered = '0'";
		$result = $this->query($query);
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}


	public function find($id){
        $query = "SELECT * FROM $this->table WHERE StudentId = :id";
        $params = [':id' => $id];
        $result = $this->query($query, $params);
        return $result ? $result[0] : null;
    }

	public function firstMatch($conditions = []){
		$where = [];
		$params = [];

		foreach($conditions as $key => $value){
			$where[] = "$key = :$key";
			$params[":$key"] = $value;
		}

		$query = "SELECT * FROM $this->table WHERE " . implode(' AND ', $where) . " LIMIT 1";

		$result = $this->query($query, $params);
		return $result ? $result[0] : null;
	}

	public function registeredCount(){
		$query = "SELECT COUNT(*) FROM $this->table WHERE registered = '1' AND block = '0'";
		$result = $this->query($query);
		if(!empty($result)){
			return $result[0]->{'COUNT(*)'};
		}

		else{
			return 0;
		}
	}

	public function workingCount(){
		$query = "SELECT COUNT(*) FROM $this->table WHERE Status = 'Recruited'";
		$result = $this->query($query);
		if(!empty($result)){
			return $result[0]->{'COUNT(*)'};
		}
		
		else{
			return 0;
		}
	}

	public function rejectedCount(){
		$query = "SELECT COUNT(*) FROM $this->table WHERE Status = 'Rejected'";
		$result = $this->query($query);
		if(!empty($result)){
			return $result[0]->{'COUNT(*)'};
		}
		
		else{
			return 0;
		}
	}

	public function appliedCount(){
		$query = "SELECT COUNT(*) FROM $this->table WHERE Status = 'Pending'";
		$result = $this->query($query);
		if(!empty($result)){
			return $result[0]->{'COUNT(*)'};
		}
		
		else{
			return 0;
		}
	}

	public function notAppliedCount(){
		$query = "SELECT COUNT(*) FROM $this->table WHERE Status = 'Not Applied'";
		$result = $this->query($query);
		if(!empty($result)){
			return $result[0]->{'COUNT(*)'};
		}
		
		else{
			return 0;
		}
	}

	public function findby($column,$data){
        $query = "SELECT * FROM $this->table WHERE $column = :data LIMIT 1";
        $params = [':data' => $data];
        $result = $this->query($query, $params);
        return $result ? $result[0] : false;
    }

	public function findStudent($data) {
        // Check if $data is an associative array or a single value
        if (is_array($data)) {
            $keys = array_keys($data);
            $query = "SELECT * FROM student WHERE ";
        
            foreach ($keys as $key) {
                $query .= $key . " = :" . $key . " AND ";
            }
        
            $query = trim($query, "AND "); // Trim the trailing "AND"
            
            $result = $this->query($query, $data);
        } else {
            // Assume $data is a single ID (like CompanyId)
            $query = "SELECT * FROM student WHERE StudentId = :StudentId";
            $result = $this->query($query, ['StudentId' => $data]);
        }
    
        return $result;
    }

	public function getWeeklyStudent($week = 5){
		$query = "SELECT YEAR(created_at) as year,
    			         WEEK(created_at, 1) as week,
                         COUNT(*) as count
				  FROM $this->table
				  WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL :week WEEK)
				  GROUP BY year, week
				  ORDER BY year DESC, week DESC
				;";
		$params = [':week' => $week];
		$result = $this->query($query, $params);
		//show($result);
		if($result){
			return $result;
		}
		else{
			return false;
		}
		
	}

	public function getWeeklyRecruitedStudent($week = 5){
		$query = "SELECT YEAR(created_at) as year,
				         WEEK(created_at, 1) as week,
						 COUNT(*) as count
				  FROM $this->table
				  WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL :week WEEK) AND Status = 'Recruited'
				  GROUP BY year, week
				  ORDER BY year DESC, week DESC
				;";
		$params = [':week' => $week];
		$result = $this->query($query, $params);
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}

}

