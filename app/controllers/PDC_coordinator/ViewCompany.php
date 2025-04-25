<?php
class ViewCompany
{
    use Controller;
    public function index()
    { // load the company details by ID
        $id = $_GET['id'] ?? null;
        
        if ($id === null) {
            echo "Invalid or missing company ID.";
            return;
        }

        $model = new company;
        $companyData = $model->findById($id);

        if (!$companyData) {
            echo "No data found";
            return;
        }
        $coordinatorId = $_SESSION['USER']->CoordinatorId;
        $companyNotificationsModel = new Company_notifications();
        $messages = $companyNotificationsModel->getChatMessages($coordinatorId, $id);

        if (!is_array($messages)) {
            $messages = [];
        }

        $formattedMessages = [];

        foreach ($messages as $message) {
            $formattedMessages[] = [
                'id' => $message->id,
                'message' => htmlspecialchars($message->message),
                'time' => date('Y-m-d H:i:s', strtotime($message->timestamp)),
                'sender' => $message->actor_id,
                'isMe' => ($message->actor_id == $coordinatorId)
            ];
        }

        // Mark messages as read
        $companyNotificationsModel->markAsRead($coordinatorId, $id);

        // Render the view with data
        $this->view('Coordinator/Company/viewCompany', [
            'companyData' => $companyData,
            'messages' => $formattedMessages
        ]);
    }

    public function getMessages()
    {
        $id = $_GET['id'] ?? null;
        if ($id === null) {
            echo json_encode(['error' => 'Invalid or missing company ID']);
            return;
        }

        $coordinatorId = $_SESSION['USER']->CoordinatorId;
        // Verify the IDs are not empty
        if (empty($coordinatorId) || empty($id)) {
            echo json_encode(['error' => 'Invalid coordinator or company ID']);
            return;
        }

        $companyNotificationsModel = new Company_notifications();
        
        // First try to get messages
        $messages = $companyNotificationsModel->getChatMessages($coordinatorId, $id);

        

        // Initialize formatted messages array
        $formattedMessages = [];
        
        // Only process if we have messages
        if ($messages && is_array($messages)) {
            foreach ($messages as $message) {
                $formattedMessage = [
                    'id' => $message->id,
                    'message' => htmlspecialchars($message->message),
                    'time' => date('Y-m-d H:i:s', strtotime($message->timestamp)),
                    'sender' => $message->actor_id,
                    'isMe' => ($message->actor_id == $coordinatorId)
                ];
                $formattedMessages[] = $formattedMessage;
                error_log("Formatted message: " . print_r($formattedMessage, true));
            }
        }

        echo json_encode($formattedMessages);
    }

    public function sendMessage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $message = $_POST['message'] ?? null;
            $coordinatorId = $_SESSION['USER']->CoordinatorId;
            $companyId = $_POST['company_id'] ?? null;

            $companyNotificationsModel = new Company_notifications();

            if (!empty($message)) {
                $result = $companyNotificationsModel->sendMessage($coordinatorId, $companyId, $message);

                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Message sent successfully.']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Failed to send message.']);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Message cannot be empty.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
        }
    }

    public function checkNewMessages($companyId)
    {
        $coordinatorId = $_SESSION['USER']->CoordinatorId;
        $lastId = $_POST['last_id'] ?? null;
        $companyNotificationsModel = new Company_notifications();
        $newMessages = $companyNotificationsModel->checkNewMessages($coordinatorId, $companyId, $lastId);

        // Initialize formatted messages array
        $formattedMessages = [];
        
        // Only process if we have messages
        if ($newMessages && is_array($newMessages)) {
            foreach ($newMessages as $message) {
                $formattedMessages[] = [
                    'id' => $message->id,
                    'message' => htmlspecialchars($message->message),
                    'time' => date('Y-m-d H:i:s', strtotime($message->timestamp)),
                    'sender' => $message->actor_id,
                    'isMe' => ($message->actor_id == $coordinatorId)
                ];
            }
        }

        // Always return a success response with messages array
        echo json_encode([
            'status' => 'success',
            'messages' => $formattedMessages,
            'new_count' => count($formattedMessages)
        ]);
    }
}
