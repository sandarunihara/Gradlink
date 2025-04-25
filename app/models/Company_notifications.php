<?php

class Company_notifications
{
    use Model;
    protected $table = 'company_notifications';

    protected $allowedColumns = [
        'id',
        'actor_id',
        'target_id',
        'message',
        'read_status',
        'timestamp',
        'type'
    ];

    public function getChat($company_id, $coordinator_id, $limit = 100)
    {
        // Ensure $limit is a safe integer
        $limit = (int)$limit;
        $query = "SELECT * FROM $this->table 
        WHERE ((actor_id = :company_id AND target_id = :coordinator_id) 
            OR (actor_id = :coordinator_id AND target_id = :company_id)) 
            AND type = 'chat' 
        ORDER BY timestamp ASC 
        LIMIT $limit";

        $params = [
            'company_id' => $company_id,
            'coordinator_id' => $coordinator_id
        ];
        return $this->query($query, $params);
    }



    //Get chat messages between 2 users

    public function getChatMessages($actor_id, $target_id){
        try {
            $query = "SELECT * FROM $this->table 
                     WHERE ((actor_id = :actor_id AND target_id = :target_id) 
                     OR (actor_id = :target_id AND target_id = :actor_id)) 
                     AND type = 'chat' 
                     ORDER BY timestamp ASC";
                     
            $params = [
                'actor_id' => $actor_id,
                'target_id' => $target_id
            ];
            
            // Log the query and parameters for debugging
            error_log("Chat Messages Query: " . $query);
            error_log("Chat Messages Params: " . print_r($params, true));
            
            $result = $this->query($query, $params);
            
            // Log the result for debugging
            error_log("Chat Messages Result: " . print_r($result, true));
            
            // Ensure we always return an array
            if (!is_array($result)) {
                error_log("Chat Messages: Result is not an array");
                return [];
            }
            
            return $result;
        } catch (Exception $e) {
            error_log("Error in getChatMessages: " . $e->getMessage());
            return [];
        }

    }

    //Send a chat message
    public function sendMessage($sender, $receiver, $message)
    {
        $data = [
            'actor_id' => $sender,
            'target_id' => $receiver,
            'message' => htmlspecialchars($message),
            'read_status' => 0,
            'timestamp' => date('Y-m-d H:i:s'),
            'type' => 'chat'
        ];

        error_log("Sending message with data: " . print_r($data, true));
        return $this->insert($data);
    }

    public function getUnRead($sender, $receiver)
    {
        $query = "UPDATE $this->table SET read_status = 0 WHERE actor_id = :actor_id AND target_id = :target_id AND type='chat'";
        $params = [
            'actor_id' => $sender,
            'target_id' => $receiver
        ];
        return $this->query($query, $params);
    }

    public function markAsRead($sender, $receiver){
        $query = "UPDATE $this->table SET read_status = 1 
                 WHERE actor_id = :actor_id AND target_id = :target_id AND type='chat'";

        $params = [
            'actor_id' => $sender,
            'target_id' => $receiver
        ];
        return $this->query($query, $params);
    }


    public function checkNewMessages($coordinatorId, $companyId, $lastId = 0)
    {
        try {
            $query = "SELECT * FROM $this->table 
                     WHERE ((actor_id = :actor_id AND target_id = :target_id) 
                     OR (actor_id = :target_id AND target_id = :actor_id)) 
                     AND type = 'chat' 
                     AND id > :last_id 
                     ORDER BY timestamp ASC";
            
            $params = [
                ':actor_id' => $coordinatorId,
                ':target_id' => $companyId,
                ':last_id' => (int)$lastId
            ];
            
            $result = $this->query($query, $params);
            
            if ($result) {
                return $result;
            }
            
            return [];
        } catch (Exception $e) {
            error_log("Error in checkNewMessages: " . $e->getMessage());
            return [];
        }

    }
}
