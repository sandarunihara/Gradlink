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
		var_dump($data);
		$this->errors = [];
		if (empty($data['StudentId'])) {
			$this->errors['StudentId'] = "Student Id is required";
		}
		if (empty($data['NIC'])) {
			$this->errors['NIC'] = "Student NIC is required";
		}
		if (empty($data['Name'])) {
			$this->errors['Name'] = "Student Name is required";
		}
		if (empty($data['Email'])) {
			$this->errors['Email'] = "Email is required";
		}
		if (empty($data['DegreeName'])) {
			$this->errors['DegreeName'] = "Degree Name is required";
		}
		if (empty($data['Status'])) {
			$this->errors['Status'] = "Status is required";
		}

		var_dump($this->errors);
		return empty($this->errors);
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
}

