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
	];

	public function validate($data) {
		$this->errors = []; // Clear errors each time validate is called
	
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
		if (empty($data['Status']) || !in_array($data['Status'], ['Not Applied', 'Pending', 'Recruited'])) {
			$this->errors['Status'] = "Please select a valid Status.";
		}
		if (empty($data['ContactNum']) || !preg_match('/^\+?\d{10,15}$/', $data['ContactNum'])) {
			$this->errors['ContactNum'] = "Contact number must be 10-15 digits and may start with '+'.";
		}
	
		return empty($this->errors); // Validation passes if no errors
	}
	
	
	
	public function findall()
    {
        $query = "SELECT * FROM $this->table";

        $result = $this->query($query);
        return $result;
		
    }

	public function find($id){
        $query = "SELECT * FROM $this->table WHERE StudentId = :id";
        $params = [':id' => $id];
        $result = $this->query($query, $params);
        return $result ? $result[0] : null;
    }

	public function count(){
		$query = "SELECT COUNT(*) FROM $this->table";
		$result = $this->query($query);
		return $result[0]->{'COUNT(*)'};
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

}

