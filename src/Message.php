<?php

class Message {
    
    private $id;
    private $title;
    private $message;
    private $senderId;
    private $sendername;
    private $recipientId;
    private $recipientname;
    private $status;
    private $sendDatetime;
    
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getSenderId() {
        return $this->senderId;
    }

    public function getSendername() {
        return $this->sendername;
    }
    
    public function getRecipientId() {
        return $this->recipientId;
    }
    
    public function getRecipientname() {
        return $this->recipientname;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getSendDatetime() {
        return $this->sendDatetime;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function setSenderId($senderId) {
        $this->senderId = $senderId;
    }

    public function setRecipientId($recipientId) {
        $this->recipientId = $recipientId;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setSendDatetime($sendDatetime) {
        $this->sendDatetime = $sendDatetime;
    }

        
    static public function sendMessage(mysqli $connection, $title, $message, $senderId, $recipientId) {
        
        $query = "INSERT INTO Messages (title, message, sender_id, recipient_id, status, send_datetime) VALUES ('" . $title . "', '" . $message . "', " . $senderId . ", " . $recipientId . ", 0, NOW())";
        $result = $connection->query($query);
        
        return $result;
        
    }
    
    static public function getAllMessages(mysqli $connection, $userId) {
        
        $query = "SELECT m.*, u.username AS sender, us.username AS recipient FROM Messages m JOIN Users u ON m.sender_id = u.id JOIN Users us ON m.recipient_id = us.id WHERE m.recipient_id = $userId";
        $result = $connection->query($query);

        if ($result == FALSE) {

            return false;

        } else if ($result->num_rows != 0) {
            
            $allMessages;

            foreach ($result as $row) {

                $message = new Message();
                $message->id = $row['id'];
                $message->title = $row['title'];
                $message->message = $row['message'];
                $message->senderId = $row['sender_id'];
                $message->sendername = $row['sender'];
                $message->recipientId = $row['recipient_id'];
                $message->recipientname = $row['recipient'];
                $message->status = $row['status'];
                $message->sendDatetime = $row['send_datetime'];

                $allMessages[] = $message;
            }

            return $allMessages;
            
        }
        
        return NULL;

    }
    
    static public function getMessageById(mysqli $connection, $id) {
        
        $query1 = "UPDATE Messages SET status=1 WHERE id=$id";
        $result1 = $connection->query($query1);
        
        $query2 = "SELECT m.*, u.username AS sender, us.username AS recipient FROM Messages m JOIN Users u ON m.sender_id = u.id JOIN Users us ON m.recipient_id = us.id WHERE m.id = " . $id;
        $result2 = $connection->query($query2);
        
        $result3 = $result2->fetch_assoc();
        
        $message = new Message();
        $message->id = $result3['id'];
        $message->title = $result3['title'];
        $message->message = $result3['message'];
        $message->senderId = $result3['sender_id'];
        $message->sendername = $result3['sender'];
        $message->recipientId = $result3['recipient_id'];
        $message->recipientname = $result3['recipient'];
        $message->status = $result3['status'];
        $message->sendDatetime = $result3['send_datetime'];
        
        return $message;
        
    }
    
    static public function getSentMessages(mysqli $connection, $sender_id) {
        
        $query = "SELECT m.*, us.username AS recipient FROM Messages m JOIN Users u ON m.sender_id = u.id JOIN Users us ON m.recipient_id = us.id WHERE m.sender_id = $sender_id ORDER BY send_datetime DESC";
        $result = $connection->query($query);

        if ($result == FALSE) {

            return false;

        } else if ($result->num_rows != 0) {
            
            $sentMessages = [];
        
            foreach ($result as $row) {

                $message = new Message();
                $message->id = $row['id'];
                $message->title = $row['title'];
                $message->message = $row['message'];
                $message->recipientId = $row['recipient_id'];
                $message->recipientname = $row['recipient'];
                $message->status = $row['status'];
                $message->sendDatetime = $row['send_datetime'];

                $sentMessages[] = $message;

            }

            return $sentMessages;
            
        }
        
        return NULL;
        
    }
    
}

