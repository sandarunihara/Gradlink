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
	];

	function findstudentad($companyId, $studentId)
	{
		// Prepare the SQL query with placeholders for parameters
		$query = "SELECT 
					*
              FROM 
                    studentadvertisement
              JOIN 
                    student ON studentadvertisement.StudentId = student.StudentId
              JOIN 
                    advertisement ON studentadvertisement.AdvertisementId = advertisement.AdvertisementId
              WHERE 
                    advertisement.CompanyId = :CompanyId 
                    AND student.StudentId = :StudentId";

		// Bind the parameters and execute the query
		$params = [
			':CompanyId' => $companyId,
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
}
