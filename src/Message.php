<?php

class Message {
    
    static public function sendMessage(mysqli $connection, $title, $message, $senderId, $recipientId) {
        
        $query = "INSERT INTO Messages (title, message, sender_id, recipient_id, status, send_datetime) VALUES ('" . $title . "', '" . $message . "', " . $senderId . ", " . $recipientId . ", 0, NOW())";
        $result = $connection->query($query);
        
        return $result;
        
    }
    
    static public function getAllMessages(mysqli $connection, $userId) {
        
        $query = "SELECT m.*, u.username AS sender, us.username AS recipient FROM Messages m JOIN Users u ON m.sender_id = u.id JOIN Users us ON m.recipient_id = us.id WHERE m.recipient_id = $userId";
        $result = $connection->query($query);

        if ($result == FALSE) {

            echo "Failed to download messages";
            return false;

        }

        $allMessages;
        
        foreach ($result as $row) {
            $allMessages[] = $row;
        }
        
        return $allMessages;
        
    }
    
    static public function getMessageById(mysqli $connection, $id) {
        
        $query = "SELECT m.*, u.username AS sender, us.username AS recipient FROM Messages m JOIN Users u ON m.sender_id = u.id JOIN Users us ON m.recipient_id = us.id WHERE m.id = " . $id;
        $result = $connection->query($query);

        if ($result == FALSE) {

            echo "Failed to download message";
            return false;

        }
        
        return $result;
        
    }
    
    static public function getSentMessages(mysqli $connection, $sender_id) {
        
        $query = "SELECT m.*, us.username AS recipient FROM Messages m JOIN Users u ON m.sender_id = u.id JOIN Users us ON m.recipient_id = us.id WHERE m.sender_id = $sender_id";
        $result = $connection->query($query);

        if ($result == FALSE) {

            echo "Failed to download sent messages";
            return false;

        }

        $sentMessages = [];
        
        foreach ($result as $row) {
            $sentMessages[] = $row;
        }
        
        return $sentMessages;
        
    }
    
}

