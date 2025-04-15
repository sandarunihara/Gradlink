<?php

class C_Advertisement
{
    use Model;

    protected $table = 'advertisement';

    public function validate($data)
    {
        $this->errors = [];
        if (empty($data['position'])) {
            $this->errors['position'] = "position is required";
        }
        if (empty($data['description'])) {
            $this->errors['description'] = "description is required";
        }
        if (empty($data['qualification'])) {
            $this->errors['qualification'] = "qualification is required";
        }
        if (empty($data['numOfInterns'])) {
            $this->errors['numOfInterns'] = "interns is required";
        }
        if (empty($data['workingMode'])) {
            $this->errors['workingMode'] = "worktype is required";
        }
        if (empty($data['deadline'])) {
            $this->errors['deadline'] = "deadline is required";
        }

        if (empty($this->errors)) {
            return true;
        }

        return $this->errors;
    }

    public function find($data)
    {
        
        if (is_array($data)) {
            $keys = array_keys($data);
            $query = "SELECT * FROM advertisement WHERE ";

            foreach ($keys as $key) {
                $query .= $key . " = :" . $key . " AND ";
            }

            $query = trim($query, "AND "); // Trim the trailing "AND"

            $result = $this->query($query, $data);
        } else {
            // Assume $data is a single ID (like CompanyId)
            $query = "SELECT * FROM advertisement WHERE advertisementId = :advertisementId";
            $result = $this->query($query, ['advertisementId' => $data]);
        }

        return $result;
    }

    public function findwithcompany($data){
        $query = "SELECT 
                    advertisement.advertisementId,
                    advertisement.position,
                    advertisement.description,
                    advertisement.qualification,
                    advertisement.numOfInterns,
                    advertisement.workingMode,
                    advertisement.deadline,
                    advertisement.CompanyId,
                    advertisement.startdate,
                    advertisement.image,
                    advertisement.status,
                    company.Name,
                    company.profileimg,
                    company.Email
                FROM 
                    advertisement
                JOIN 
                    company ON advertisement.CompanyId = company.CompanyId
                WHERE
                    advertisementId = :advertisementId";

        $result = $this->query($query, ['advertisementId' => $data]);
        return $result ? $result[0] : null;
    }

    function findall()
    {
        $query = "SELECT * FROM advertisement";

        $result = $this->query($query);
        return $result;
    }

    public function gethighestadid()
    {
        $query = "SELECT advertisementId FROM advertisement ORDER BY advertisementId DESC LIMIT 1";
        $result = $this->query($query);
        return $result ? $result[0]->advertisementId : null;
    }

    public function delete1($id, $id_column)
    {
        $data[$id_column] = $id;
        $query = "DELETE FROM $this->table WHERE $id_column = :$id_column";

        // Execute the query
        $stmt = $this->query($query, $data);
        //show($stmt);
        if (is_array($stmt)) {
            $stmt = (object) $stmt;
        }

        if ($stmt && $stmt->rowCount() > 0) {
            return "Record deleted successfully.";
        } else {
            return 'false';
        }
    }

    public function findallActivewithCompany(){
        $query = "SELECT 
                    advertisement.advertisementId,
                    advertisement.position,
                    advertisement.description,
                    advertisement.qualification,
                    advertisement.numOfInterns,
                    advertisement.workingMode,
                    advertisement.deadline,
                    advertisement.CompanyId,
                    advertisement.startdate,
                    advertisement.image,
                    company.Name,
                    company.profileimg
                FROM 
                    advertisement
                JOIN 
                    company ON advertisement.CompanyId = company.CompanyId
                WHERE
                    advertisement.status = 'Active'";


        $result = $this->query($query);
        return $result;
    }

    public function findAllPending(){
        $query = "SELECT 
                    advertisement.advertisementId,
                    advertisement.position,
                    advertisement.description,
                    advertisement.qualification,
                    advertisement.numOfInterns,
                    advertisement.workingMode,
                    advertisement.deadline,
                    advertisement.CompanyId,
                    advertisement.startdate,
                    advertisement.image,
                    company.Name,
                    company.profileimg,
                FROM 
                    advertisement
                JOIN 
                    company ON advertisement.CompanyId = company.CompanyId
                WHERE
                    advertisement.status = 'Pending'";


        $result = $this->query($query);
        //show($result);
        return $result;
    }


    public function findAllPendingcount(){
        $query = "SELECT COUNT(*) AS total FROM $this->table WHERE status = 'Pending'";

        $result = $this->query($query);
        //show($result);
        return $result[0]->{'total'};
    }

    public function findallDeactivewithCompany(){
        $query = "SELECT 
                    advertisement.advertisementId,
                    advertisement.position,
                    advertisement.description,
                    advertisement.qualification,
                    advertisement.numOfInterns,
                    advertisement.workingMode,
                    advertisement.deadline,
                    advertisement.CompanyId,
                    advertisement.startdate,
                    advertisement.image,
                    company.Name,
                    company.profileimg
                FROM 
                    advertisement
                JOIN 
                    company ON advertisement.CompanyId = company.CompanyId
                WHERE
                    advertisement.status = 'Deactive'";

        $result = $this->query($query);
        return $result;
    }

    public function findallRejectedwithCompany(){
        $query = "SELECT 
                    advertisement.advertisementId,
                    advertisement.position,
                    advertisement.description,
                    advertisement.qualification,
                    advertisement.numOfInterns,
                    advertisement.workingMode,
                    advertisement.deadline,
                    advertisement.CompanyId,
                    advertisement.startdate,
                    advertisement.image,
                    company.Name,
                    company.profileimg
                FROM 
                    advertisement
                JOIN 
                    company ON advertisement.CompanyId = company.CompanyId
                WHERE
                    advertisement.status = 'Rejected'";

        $result = $this->query($query);
        return $result;
    }

    public function OngoingAdvertisementCount() {
        try{
            $query = "SELECT COUNT(*) AS total FROM advertisement WHERE status = 'active'";

            $result = $this->query($query);
			return $result[0]->{'total'};
        }catch (Exception $e) {
			error_log("Error fetching total number of advertisements: " . $e->getMessage());
			return false;
		}
    }

    public function deactivate($id){
        $query = "UPDATE $this->table SET status = 'Deactive' WHERE advertisementId = :advertisementId";
        $result = $this->query($query, ['advertisementId' => $id]);
        var_dump($result);
        //return $result;
    }

    public function topAdvertisement(){
        $query = "SELECT
                    a.advertisementId,
                    a.position,
                    a.deadline,
                    a.workingMode,
                    c.Name
                    FROM advertisement a
                    JOIN company c ON a.CompanyId = c.CompanyId
                    WHERE deadline >= CURDATE()  
                    ORDER BY deadline ASC
                    LIMIT 3";
        $result = $this->query($query);
        return $result;
    }

    public function topCompanyByAdd(){
        $query = "SELECT
                    c.CompanyId,
                    c.Name,
                    c.profileimg,
                    COUNT(a.advertisementId) AS ad_count
                    FROM advertisement a
                    JOIN company c ON  a.CompanyId = c.CompanyId
                    GROUP BY c.CompanyId
                    ORDER BY ad_count DESC
                    LIMIT 2";
        $result = $this->query($query);
        return $result;
    }
}
