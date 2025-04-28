<?php

class Coordinator_Dash
{
    use Model;


    public function unreadComplaintsCount(){
        try {
            $query = "SELECT COUNT(*) AS unreadComplaints
                        FROM complaint
                        WHERE status = 'notReviewed'";

            $result = $this->query($query);
            return $result[0]->{'unreadComplaints'};
        } catch (Exception $e) {
            error_log("Error fetching unread complaints count: " . $e->getMessage());
            return false;
        }
    }

    public function readComplaintsCount(){
        try {
            $query = "SELECT COUNT(*) AS readComplaints
                        FROM complaint
                        WHERE status = 'Reviewed'";

            $result = $this->query($query);
            return $result[0]->{'readComplaints'};
        } catch (Exception $e) {
            error_log("Error fetching read complaints count: " . $e->getMessage());
            return false;
        }
    }

    public function totalApplicationsCount(){
        try {
            $query = "SELECT COUNT(*) AS totalApplications
                        FROM studentadvertisement
                        WHERE Jobstatus NOT IN ('Reject', 'Recruit')";

            $result = $this->query($query);
            return $result[0]->{'totalApplications'};
        } catch (Exception $e) {
            error_log("Error fetching total applications count: " . $e->getMessage());
            return false;
        }
    }

    public function recruitedCount(){
        try {
            $query = "SELECT COUNT(*) AS recruitedCount
                        FROM studentadvertisement
                        WHERE Jobstatus = 'Recruit'";

            $result = $this->query($query);
            return $result[0]->{'recruitedCount'};
        } catch (Exception $e) {
            error_log("Error fetching recruited count: " . $e->getMessage());
            return false;
        }
    }

   public function pendingAdvertisementCount(): mixed
    {
        try {
            $query = "SELECT COUNT(*) AS pendingAdvertisementCount
                        FROM advertisement
                        WHERE status = 'Request'";

            $result = $this->query($query);
            return $result[0]->{'pendingAdvertisementCount'};
        } catch (Exception $e) {
            error_log("Error fetching pending advertisement count: " . $e->getMessage());
            return false;
        }
    }

    public function pendingCompanyCount(): mixed
    {
        try {
            $query = "SELECT COUNT(*) AS pendingCompanyCount
                        FROM company
                        WHERE Status = 'Pending'";

            $result = $this->query($query);
            return $result[0]->{'pendingCompanyCount'};
        } catch (Exception $e) {
            error_log("Error fetching pending company count: " . $e->getMessage());
            return false;
        }
    }

    public function blockedCompanyCount(){
        try {
            $query = "SELECT COUNT(*) AS blockedCompanyCount
                        FROM company
                        WHERE block = 1";

            $result = $this->query($query);
            return $result[0]->{'blockedCompanyCount'};
        } catch (Exception $e) {
            error_log("Error fetching blocked company count: " . $e->getMessage());
            return false;
        }
    }

    public function blockedStudentCount(){
        try {
            $query = "SELECT COUNT(*) AS blockedStudentCount
                        FROM student
                        WHERE block = 1";

            $result = $this->query($query);
            return $result[0]->{'blockedStudentCount'};
        } catch (Exception $e) {
            error_log("Error fetching blocked student count: " . $e->getMessage());
            return false;
        }
    }
    

    public function pendingCSCount(): mixed
    {
        try {
            $query = "SELECT COUNT(*) AS pendingTotal
                        FROM student
                        JOIN studentadvertisement ON studentadvertisement.StudentId = student.StudentId
                        WHERE studentadvertisement.jobstatus IN ('Pending', 'Shortlist') AND student.DegreeName = 'Computer Science'";

            $result = $this->query($query);
            return $result[0]->{'pendingTotal'};
        } catch (Exception $e) {
            error_log("Error fetching total number of pending CS students: " . $e->getMessage());
            return false;
        }
    }

    public function rejectedCSCount(): mixed
    {
        try {
            $query = "SELECT COUNT(*) AS rejectedTotal
                        FROM student
                        JOIN studentadvertisement ON studentadvertisement.StudentId = student.StudentId
                        WHERE studentadvertisement.jobstatus = 'Reject' AND student.DegreeName = 'Computer Science'";

            $result = $this->query($query);
            return $result[0]->{'rejectedTotal'};
        } catch (Exception $e) {
            error_log("Error fetching total number of rejected CS students: " . $e->getMessage());
            return false;
        }

    }

    public function recruitedCSCount(): mixed
    {
        try {
            $query = "SELECT COUNT(*) AS recruitedTotal
                        FROM student
                        JOIN studentadvertisement ON studentadvertisement.StudentId = student.StudentId
                        WHERE studentadvertisement.jobstatus = 'Recruit' AND student.DegreeName = 'Computer Science'";

            $result = $this->query($query);
            return $result[0]->{'recruitedTotal'};
        } catch (Exception $e) {
            error_log("Error fetching total number of recruited CS students: " . $e->getMessage());
            return false;
        }
    }

    public function totalCSCount(): mixed
    {
        try {
            $query = "SELECT COUNT(*) AS CSTotal
                        FROM student
                        WHERE student.DegreeName = 'Computer Science'";

            $result = $this->query($query);
            return $result[0]->{'CSTotal'};
        } catch (Exception $e) {
            error_log("Error fetching total number CS students: " . $e->getMessage());
            return false;
        }
    }

    public function pendingISCount(): mixed
    {
        try {
            $query = "SELECT COUNT(*) AS pendingTotal
                        FROM student
                        JOIN studentadvertisement ON studentadvertisement.StudentId = student.StudentId
                        WHERE studentadvertisement.jobstatus IN ('Pending', 'Shortlist') AND student.DegreeName = 'Information System'";

            $result = $this->query($query);
            return $result[0]->{'pendingTotal'};
        } catch (Exception $e) {
            error_log("Error fetching total number of pending IS students: " . $e->getMessage());
            return false;
        }
    }

    public function rejectedISCount(): mixed
    {
        try {
            $query = "SELECT COUNT(*) AS rejectedTotal
                        FROM student
                        JOIN studentadvertisement ON studentadvertisement.StudentId = student.StudentId
                        WHERE studentadvertisement.jobstatus = 'Reject' AND student.DegreeName = 'Information System'";

            $result = $this->query($query);
            return $result[0]->{'rejectedTotal'};
        } catch (Exception $e) {
            error_log("Error fetching total number of rejected IS students: " . $e->getMessage());
            return false;
        }

    }

    public function recruitedISCount(): mixed
    {
        try {
            $query = "SELECT COUNT(*) AS recruitedTotal
                        FROM student
                        JOIN studentadvertisement ON studentadvertisement.StudentId = student.StudentId
                        WHERE studentadvertisement.jobstatus = 'Recruit' AND student.DegreeName = 'Information System'";

            $result = $this->query($query);
            return $result[0]->{'recruitedTotal'};
        } catch (Exception $e) {
            error_log("Error fetching total number of recruited IS students: " . $e->getMessage());
            return false;
        }
    }

    public function totalISCount(): mixed
    {
        try {
            $query = "SELECT COUNT(*) AS ISTotal
                        FROM student
                        WHERE student.DegreeName = 'Information System'";

            $result = $this->query($query);
            return $result[0]->{'ISTotal'};
        } catch (Exception $e) {
            error_log("Error fetching total number of IS students: " . $e->getMessage());
            return false;
        }
    }

    public function jobRoles(): mixed
    {
        try {
            $query = "SELECT position, COUNT(*) as count FROM advertisement GROUP BY position";

            $result = $this->query($query);
            return $result;
        } catch (Exception $e) {
            error_log("Error fetching job roles: " . $e->getMessage());
            return false;
        }
    }

    public function getScheduledSessions()
    {
        try {
            $query = "SELECT * FROM session WHERE session_date >= CURDATE() AND deleted = 0";
            $result = $this->query($query);
    
            if ($result === false) {
                throw new Exception("Database query failed");
            }
    
            return $result ?: []; // Ensure an empty array is returned if no results
        } catch (Exception $e) {
            error_log("Error fetching SESSIONS: " . $e->getMessage());
            return []; // Return an empty array instead of false to prevent errors in views
        }
    }

    public function companyLocations(): mixed
    {
        try {
            $query = "SELECT District, COUNT(*) as count FROM company GROUP BY District";
            $result = $this->query($query);
            return $result;
        }
        catch (Exception $e) {
            error_log("Error fetching job roles: " . $e->getMessage());
            return false;
        }
    }

    public function countByCompanyStatus(): mixed
    {
        try {
            $query = "SELECT Status, COUNT(*) as count FROM company GROUP BY Status";
            $result = $this->query($query);
            return $result;
        }
        catch (Exception $e) {
            error_log("Error fetching company status: " . $e->getMessage());
            return false;
        }

    }

}