<?php
class ReviewedComplaints
{
    use Controller;
    public function index()
    {
        $complaintModel = new complaint;
        $complaints = $complaintModel->findAllReviewed();

        // echo "<pre>";
        // print_r($complaints);
        // echo "</pre>";

        if ($complaints == null) {
            $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'No reviewed complaints found.'];
            $complaints = [];
        } else {
            // Add 'type' to each complaint (student or company)
            foreach ($complaints as $complaint) {
                $complaint->type = $complaint->StudentId ? 'student' : 'company';
            }
            // unset($complaint); // break the reference
        }

        $this->view('Coordinator/Complain/reviewedComplaints', [
            'complaints' => $complaints
        ]);
    }
}
