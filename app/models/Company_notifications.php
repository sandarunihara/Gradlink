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
    public function getChatMessages($actor_id, $target_id, $limit = 100)
    {
        $query = "SELECT * FROM $this->table WHERE (actor_id = :actor_id AND target_id = :target_id) OR (actor_id = :target_id AND target_id = :actor_id) AND type='chat' ORDER BY timestamp ASC LIMIT :limit";
        $params = [
            'actor_id' => $actor_id,
            'target_id' => $target_id,
            'limit' => $limit
        ];
        return $this->query($query, $params);
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

        return $this->insert($data);
    }

    public function markAsRead($sender, $receiver)
    {
        $query = "UPDATE $this->table SET read_status = 1 WHERE actor_id = :actor_id AND target_id = :target_id AND type='chat'";
        $params = [
            'actor_id' => $sender,
            'target_id' => $receiver
        ];
        return $this->query($query, $params);
    }

    public function checkNewMessages($sender, $receiver, $last_id)
    {
        $query = "SELECT * FROM $this->table WHERE ((actor_id = :actor_id AND target_id = :target_id) OR (actor_id = :target_id AND target_id = :actor_id)) AND type='chat' AND id > :last_id ORDER BY timestamp ASC";
        $params = [
            'actor_id' => $sender,
            'target_id' => $receiver,
            'last_id' => $last_id
        ];
        return $this->query($query, $params);
    }
}
