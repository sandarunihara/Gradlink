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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'] ?? null; // Get the ID from the POST request

            // echo "<pre>";
            // print_r($id);
            // echo "</pre>";
            if ($id) {
                $complaintModel = new complaint;
                $complaintModel->markReviewed($id);

                // $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Complaint marked as reviewed successfully.'];

                echo json_encode([
                    'success' => true,
                    'message' => 'Complaint marked as reviewed.',

                ]);
                // Redirect to the index method after marking as reviewed

            } else {
                $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Invalid complaint ID.'];
            }
        }
    }

    public function addReply()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reply = $_POST['reply'] ?? null; // Get the reply from the POST request
            $complaintId = $_POST['complaintId'] ?? null; // Get the complaint ID from the POST request

            //      echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";

            if ($reply && $complaintId) {
                $complaintModel = new complaint;
                $success = $complaintModel->addReply($complaintId, $reply);

                $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Reply added successfully.'];
                
            } else {
                $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Invalid input.'];
            }
            header("Location: " . ROOT . "/PDC_coordinator/dashboardComplaints");
            exit;
        }
    }

    //   
}
