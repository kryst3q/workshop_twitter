<?php

class Tweet {
    
    private $id;
    private $userId;
    private $text;
    private $creationDate;
    
    public function __construct() {
        $this->id = -1;
        $this->userId = 0;
        $this->text = "";
        $this->creationDate = '';
    }
    
    public function getId() {
        
        return $this->id;
        
    }
    
    public function getuserId() {
        
        return $this->userId;
        
    }
    
    public function getText() {
        
        return $this->text;
        
    }
    
    public function getCreationDate() {
        
        return $this->creationDate;
        
    }
    
    public function setUserId($userId) {
        
        if (is_int($userId)) {
            
            $this->userId = $userId;
            return TRUE;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    public function setText($text) {
        
        if (is_string($text)) {
            
            $this->text = $text;
            return TRUE;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    public function setCreationDate($creationDate) {
        
        $this->creationDate = $creationDate;
        
    }
    
    static public function addNewTweet(mysqli $connection, $userID, $tweet) {
        
        $query = "INSERT INTO Tweets (user_id, tweet, send_datetime) VALUES ($userID, '" . $tweet . "', NOW())";
        $connection->query($query);
        
        return;
        
    }
    
    static public function loadTweetById(mysqli $connection, $id) {

        $sql = "SELECT * FROM Tweets WHERE id=" . $id;

        $result = $connection->query($sql);

        if (($result == TRUE) && ($result->num_rows == 1)) {

            $row = $result->fetch_assoc();

            $loadedTweet = new Tweet();
            $loadedTweet->id = $row['id'];
            $loadedTweet->userId = $row['user_id'];
            $loadedTweet->text = $row['text'];
            $loadedTweet->creationDate = $row['creation_date'];

            return $loadedTweet;
        }
        return NULL;
    }
    
    static public function loadAllTweetsByUserId(mysqli $connection, $userId) {
        
        $allTweets = [];
    
        $query = "SELECT t.*, u.username FROM Tweets t JOIN Users u ON t.user_id=u.id WHERE t.user_id=$userId ORDER BY t.creation_date DESC";
        $result = $connection->query($query);

        if ($result == FALSE) {

            return false;

        }

        foreach ($result as $row) {
            $allTweets[] = $row;
        }
        
        return $allTweets;
        
    }
    
    static public function loadAllTweets(mysqli $connection) {
        
        $allTweets = [];
    
        $query = "SELECT t.*, u.username FROM Tweets t JOIN Users u ON t.user_id=u.id ORDER BY t.creation_date DESC";
        $result = $connection->query($query);

        if ($result == FALSE) {

            return false;

        }

        foreach ($result as $row) {
            $allTweets[] = $row;
        }
        
        return $allTweets;
        
    }
    
    static public function getNoOfTweets(mysqli $connection) {
        
        return count($this->getAllTweets($connection));
        
    }
    
    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {
            $sql = "INSERT INTO Tweets (user_id, text, creation_date) VALUES ($this->userId, '$this->text', '$this->creationDate')";
            $result = $connection->query($sql);
            if ($result) {
                $this->id = $connection->insert_id;
                return TRUE;
            }
        }
        return false;
    }
    
}

