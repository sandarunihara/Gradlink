<?php
class DashboardComplaints
{
    use Controller;
    public function index()
    {
        $complaintModel = new complaint;
        $complaints = $complaintModel->findAllNotReviewed();

        // echo "<pre>";
        // print_r($complaints);
        // echo "</pre>";

        if ($complaints == null) {
            $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'No complaints found.'];
            $complaints = [];
        } else {
            // Add 'type' to each complaint (student or company)
            foreach ($complaints as $complaint) {
                $complaint->type = $complaint->StudentId ? 'student' : 'company';
            }
            // unset($complaint); // break the reference
        }

        $this->view('Coordinator/Complain/dashboardComplaints', [
            'complaints' => $complaints
        ]);
    }

    public function markReviewed()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];

            if($id) {
                $complaintModel = new complaint;
                $result = $complaintModel->markReviewed($id);

                if($result) {
                    $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Complaint marked as reviewed.'];
                } else {
                    $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Failed to mark complaint as reviewed.'];
                }
            } else {
                $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Invalid complaint ID.'];
            }
            
        } 
    }
}
