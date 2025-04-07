<?php
class student_advertisement
{

	use Model;

	protected $table = 'studentadvertisement';

	protected $allowedColumns = [

		'Date',
		'StudentId',
		'AdvertisementId',
		'JobStatus',
		'CV',
	];


	function findall(){
		$query = "SELECT 
    				s.*,a.*,c.*,sa.*,c.Name AS CompanyName,s.Name AS StudentName,c.Email AS CompanyEmail,s.Email AS StudentEmail
					FROM studentadvertisement sa
					JOIN student s ON sa.StudentId = s.StudentId 
					JOIN advertisement a ON sa.AdvertisementId = a.AdvertisementId  
					JOIN company c ON a.CompanyId = c.CompanyId;
					";
		$result = $this->query($query);
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}

	function findstudentad($advertisementId, $studentId)
	{
		// Prepare the SQL query with placeholders for parameters
		$query = "SELECT 
    				s.*,a.*,c.*,sa.*,c.Name AS CompanyName,s.Name AS StudentName,c.Email AS CompanyEmail,s.Email AS StudentEmail
					FROM studentadvertisement sa
					JOIN student s ON sa.StudentId = s.StudentId 
					JOIN advertisement a ON sa.AdvertisementId = a.AdvertisementId  
					JOIN company c ON a.CompanyId = c.CompanyId
              		WHERE 
                    a.advertisementId = :advertisementId 
                    AND s.StudentId = :StudentId";


		$params = [
			':advertisementId' => $advertisementId,
			':StudentId' => $studentId
		];

		// Assuming `query` method handles the prepared statement and returns the result
		$result = $this->query($query, $params);

		return $result;
	}

	public function delete1($id, $id_column) {
		$data[$id_column] = $id;
		$query = "DELETE FROM $this->table WHERE $id_column = :$id_column";
		
		// Execute the query
		$stmt = $this->query($query, $data);
		//show($stmt);
		if (is_array($stmt)) {
			$stmt = (object) $stmt;
		}

		if ($stmt & $stmt->rowCount() > 0) {
			return "Record deleted successfully.";
		} else {
			return "Error: Record could not be deleted.";
		}
	}
	function findAppliedCompanies($studentId){
		$query = "SELECT 
					studentadvertisement.Jobstatus, 
					studentadvertisement.CreatedAt,
					advertisement.position, 
					advertisement.advertisementId,
					company.Name,
					company.profileimg
              FROM 
                    studentadvertisement
              JOIN 
                    advertisement ON studentadvertisement.advertisementId = advertisement.advertisementId
              JOIN 
                    company ON advertisement.CompanyId = company.CompanyId
              WHERE 
                    studentadvertisement.StudentId = :StudentId";
		$params = [
			':StudentId' => $studentId
		];
		$result = $this->query($query, $params);

		return $result;
	}
	function findRecruitCompany($studentId){
		$query ="SELECT
					advertisement.CompanyId
				FROM
					advertisement
				JOIN
					studentadvertisement ON advertisement.advertisementId = studentadvertisement.advertisementId
				WHERE
					studentadvertisement.StudentId = :StudentId AND studentadvertisement.JobStatus = 'Recruit'";
		$params = [
			':StudentId' => $studentId
		];
		$result = $this->query($query, $params);
		return $result[0] -> CompanyId;
	}

	public function find($data) {
        // Check if $data is an associative array or a single value
        if (is_array($data)) {
            $keys = array_keys($data);
            $query = "SELECT * FROM studentadvertisement WHERE ";
        
            foreach ($keys as $key) {
                $query .= $key . " = :" . $key . " AND ";
            }
        
            $query = trim($query, "AND "); // Trim the trailing "AND"
            
            $result = $this->query($query, $data);
        } else {
            // Assume $data is a single ID (like CompanyId)
            $query = "SELECT * FROM studentadvertisement WHERE StudentId = :StudentId";
            $result = $this->query($query, ['StudentId' => $data]);
        }
    
        return $result;
    }
}
