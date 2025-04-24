<?php

class Company_notifications{
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

    //Get chat messages between 2 users
    public function getChatMessages($actor_id, $target_id){
        error_log("Getting chat messages for actor_id: $actor_id and target_id: $target_id");
        
        // First check if the table exists
        $tableCheck = $this->query("SHOW TABLES LIKE '$this->table'");
        error_log("Table check result: " . print_r($tableCheck, true));
        
        // Get table structure
        $structure = $this->query("DESCRIBE $this->table");
        error_log("Table structure: " . print_r($structure, true));
        
        $query = "SELECT * FROM $this->table 
                 WHERE ((actor_id = :actor_id AND target_id = :target_id) 
                 OR (actor_id = :target_id AND target_id = :actor_id)) 
                 AND type = 'chat' 
                 ORDER BY timestamp ASC";
                 
        $params = [
            'actor_id' => $actor_id,
            'target_id' => $target_id
        ];
        
        error_log("Executing query: $query with params: " . print_r($params, true));
        
        $result = $this->query($query, $params);
        
        error_log("Query result: " . print_r($result, true));
        
        // If no results, try a simpler query to check if there are any messages at all
        if (empty($result)) {
            $checkQuery = "SELECT COUNT(*) as count FROM $this->table WHERE type = 'chat'";
            $countResult = $this->query($checkQuery);
            error_log("Total chat messages count: " . print_r($countResult, true));
        }
        
        // Ensure we always return an array
        return is_array($result) ? $result : [];
    }

    //Send a chat message
    public function sendMessage($sender, $receiver, $message){
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

    public function markAsRead($sender, $receiver){
        $query = "UPDATE $this->table SET read_status = 1 
                 WHERE actor_id = :actor_id AND target_id = :target_id AND type='chat'";
        $params = [
            'actor_id' => $sender,
            'target_id' => $receiver
        ];
        return $this->query($query, $params);
    }

    public function checkNewMessages($sender, $receiver, $last_id){
        $query = "SELECT * FROM $this->table 
                 WHERE ((actor_id = :actor_id AND target_id = :target_id) 
                 OR (actor_id = :target_id AND target_id = :actor_id)) 
                 AND type='chat' AND id > :last_id 
                 ORDER BY timestamp ASC";
        $params = [
            'actor_id' => $sender,
            'target_id' => $receiver,
            'last_id' => $last_id
        ];
        return $this->query($query, $params);
    }

}