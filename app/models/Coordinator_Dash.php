<?php

class Coordinator_Dash
{
    use Model;

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
        }catch (Exception $e) {
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
        }catch (Exception $e) {
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
        }catch (Exception $e) {
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
        }catch (Exception $e) {
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
        }catch (Exception $e) {
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
        }catch (Exception $e) {
            error_log("Error fetching total number of IS students: " . $e->getMessage());
            return false;
        }
    }



}