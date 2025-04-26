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
		'Interview_mark',
	];


	function findall(){
		$query = "SELECT 
    				s.*,a.*,c.*,sa.*,c.Name AS CompanyName,s.Name AS StudentName,c.Email AS CompanyEmail,s.Email AS StudentEmail
					FROM studentadvertisement sa
					JOIN student s ON sa.StudentId = s.StudentId 
					JOIN advertisement a ON sa.AdvertisementId = a.AdvertisementId  
					JOIN company c ON a.CompanyId = c.CompanyId
					WHERE sa.Jobstatus != 'Recruit';
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
		// show($result);
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
	function findAppliedCompaniesByAdvertisementId($studentId,$advertisementId){
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
                    studentadvertisement.StudentId = :StudentId AND studentadvertisement.AdvertisementId = :AdvertisementId";
		$params = [
			':StudentId' => $studentId,
			':AdvertisementId' => $advertisementId
		];
		$result = $this->query($query, $params);

		return $result;
	}
	function findInternshipOfferDetails($studentId){
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
                    studentadvertisement.StudentId = :StudentId AND studentadvertisement.JobStatus = 'Accept'";
		$params = [
			':StudentId' => $studentId
		];
		$result = $this->query($query, $params);

		return $result;
	}

	function noOfAppliedCompanies($studentId){
		$query = "SELECT COUNT(*) AS count FROM studentadvertisement WHERE StudentId = :StudentId AND JobStatus != 'Reject'";
		$params = [':StudentId' => $studentId];
		$result = $this->query($query, $params);
		if(!empty($result)){
			return $result[0]->count;
		}
		
		else{
			return 0;
		}
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
	

	function findExceptRecruited(){
		$query = "SELECT 
    				s.*,a.*,c.*,sa.*,c.Name AS CompanyName,s.Name AS StudentName,c.Email AS CompanyEmail,s.Email AS StudentEmail
					FROM studentadvertisement sa
					JOIN student s ON sa.StudentId = s.StudentId 
					JOIN advertisement a ON sa.AdvertisementId = a.AdvertisementId  
					JOIN company c ON a.CompanyId = c.CompanyId
					WHERE sa.Jobstatus != 'Recruit';
					";
		$result = $this->query($query);
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}

	function findRecruitedList(){
		$query = "SELECT 
    				s.*,a.*,c.*,sa.*,c.Name AS CompanyName,s.Name AS StudentName,c.Email AS CompanyEmail,s.Email AS StudentEmail
					FROM studentadvertisement sa
					JOIN student s ON sa.StudentId = s.StudentId 
					JOIN advertisement a ON sa.AdvertisementId = a.AdvertisementId  
					JOIN company c ON a.CompanyId = c.CompanyId
					WHERE sa.Jobstatus = 'Recruit';
					";
		$result = $this->query($query);
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}
	function findresumes($studentId){
		$query = "SELECT sa.CV, a.position, c.Name
			FROM studentadvertisement sa 
			JOIN advertisement a ON sa.AdvertisementId = a.AdvertisementId
			JOIN company c ON a.CompanyId = c.CompanyId
			WHERE sa.StudentId = :StudentId";
		$params = [
			':StudentId' => $studentId
		];
		$result = $this->query($query, $params);
		if($result){
			return $result;
		}
		else{
			return false;
		}
	}
	function updateJobStatus($advertisementId, $studentId, $jobStatus){
		$query = "UPDATE studentadvertisement SET JobStatus = :JobStatus WHERE AdvertisementId = :AdvertisementId AND StudentId = :StudentId";
		$params = [
			':JobStatus' => $jobStatus,
			':AdvertisementId' => $advertisementId,
			':StudentId' => $studentId
		];
		$result = $this->query($query, $params);
		if(!$result){
			return true;
		}else{
			return false;
		}
	}
	public function deleteStudentAD($conditions)
    {
        // Build the WHERE clause dynamically from the $conditions array
        $whereClauses = [];
        foreach ($conditions as $column => $value) {
            $whereClauses[] = "$column = :$column";
        }

        $whereSQL = implode(' AND ', $whereClauses);
        $query = "DELETE FROM $this->table WHERE $whereSQL";

        // Execute the query and check if successful
        $success = $this->query($query, $conditions);
        if (!$success) {
            return true;
        } else {
            return false;
        }
    }
	public function deleteAllOtherStudentApplications($studentId)
	{
		$query = "DELETE FROM $this->table WHERE StudentId = :StudentId AND JobStatus != 'Reject'";
		$params = [':StudentId' => $studentId];
		$success = $this->query($query, $params);
		if (!$success) {
			return true;
		} else {
			return false;
		}
	}
}
