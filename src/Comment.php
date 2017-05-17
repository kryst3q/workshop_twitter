<?php

class Comment {
    
    private $id;
    private $userId;
    private $tweetId;
    private $creationDate;
    private $text;
    
    public function __construct() {
        
        $this->id = -1;
        $this->userId = 0;
        $this->tweetId = 0;
        $this->creationDate = '';
        $this->text = "";
        
    }


    public function getId() {
        return $this->id;
    }
    
    public function getUserId() {
        return $this->userId;
    }
    
    public function getTweetId() {
        return $this->tweetId;
    }
    
    public function getCreationDate() {
        return $this->creationDate;
    }
    
    public function getText() {
        return $this->text;
    }
    
    private function validId($id) {
        
        if ((is_int($id)) && ($id > 0)) {
            return TRUE;
        } else {
            return FALSE;
        }
        
    }

    public function setId($id) {
        
        if ($this->validId($id)) {
            $this->id = $id;
            return TRUE;
        } else {
            return FALSE;
        }
        
    }

    public function setUserId($userId) {
        
        if ($this->validId($userId)) {
            $this->userId = $userId;
            return TRUE;
        } else {
            return FALSE;
        }
        
    }
    
    public function setTweetId($tweetId) {
        
        if ($this->validId($tweetId)) {
            $this->tweetId = $tweetId;
            return TRUE;
        } else {
            return FALSE;
        }
        
    }
    
    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }
    
    public function setText($text) {
        if (is_string($text)) {
            $this->text = $text;
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    static public function loadCommentById(mysqli $connection, $commentId) {
        
        if (self::validId($commentId)) {
            
            $query = "SELECT * FROM Comments WHERE id=$commentId";
            $result = $connection->query($query);
            
            if (($result == TRUE) && ($result->num_rows == 1)) {
                
                $row = $result->fetch_assoc();
                
                $loadedComment = new Comment();
                $loadedComment->setId((int)$row['id']);
                $loadedComment->setTweetId((int)$row['tweet_id']);
                $loadedComment->setUserId((int)$row['user_id']);
                $loadedComment->setText($row['text']);
                $loadedComment->setCreationDate($row['creation_date']);
                
                return $loadedComment;
                
            }
            return NULL;
            
        } else {
            return FALSE;
        }
        
    }
    
    static public function loadAllCommentsByPostId(mysqli $connection, $tweetId) {
        
        if (self::validId($tweetId)) {
            
            $query = "SELECT * FROM Comments WHERE tweet_id=$tweetId ORDER BY creation_date DESC";
            $result = $connection->query($query);
            
            if ($result->num_rows != 0) {
                
                $comments = [];
                
                foreach ($result as $row) {
                    
                    $loadedComment = new Comment();
                    $loadedComment->setId((int)$row['id']);
                    $loadedComment->setTweetId((int)$row['tweet_id']);
                    $loadedComment->setUserId((int)$row['user_id']);
                    $loadedComment->setText($row['text']);
                    $loadedComment->setCreationDate($row['creation_date']);
                    
                    array_push($comments, $loadedComment);
                }
                
                return $comments;
            }
            return NULL;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    public function saveToDB(mysqli $connection) {
        
        if ($this->id == -1) {
            $sql = "INSERT INTO Comments (text, tweet_id, user_id, creation_date) VALUES "
                    . "('$this->text', $this->tweetId, $this->userId, '$this->creationDate')";
            $result = $connection->query($sql);
            if ($result) {
                $this->id = $connection->insert_id;
                return TRUE;
            }
        }
        
        return FALSE;
        
    }
    
}
