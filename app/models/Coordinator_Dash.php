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
                        WHERE studentadvertisement.jobstatus = 'Pending' AND student.DegreeName = 'Computer Science'";

            $result = $this->query($query);
            return $result[0]->{'pendingTotal'};
        } catch (Exception $e) {
            error_log("Error fetching total number of pending CS students: " . $e->getMessage());
            return false;
        }
    }

}