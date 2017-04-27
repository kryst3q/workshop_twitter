<?php

class User {

    private $id;
    private $email;
    private $username;
    private $hashedPassword;

    public function __construct() {
        $this->id = -1;
        $this->email = "";
        $this->username = "";
        $this->hashedPassword = "";
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getHashedPassword() {
        return $this->hashedPassword;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setHashedPassword($password) {
        $this->hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    }

    public function saveToDB(mysqli $connection) {

        if ($this->id == -1) {
            $sql = "INSERT INTO Users (email, username, hashed_password) VALUES "
                    . "('$this->email', '$this->username', '$this->hashedPassword')";
            $result = $connection->query($sql);
            if ($result) {
                $this->id = $connection->insert_id;
                return TRUE;
            }
        } else {
            $sql = "UPDATE Users SET username='$this->username', email='$this->email', hashed_password='$this->hashedPassword' WHERE id=$this->id";
            $result = $connection->query($sql);
            if($result == TRUE){
                return TRUE;
            }
        }
        return false;
    }
    
    public function delete(mysqli $connection) {
        
        if ($this->id != -1) {
            
            $sql = "DELETE FROM Users WHERE id= $this->id";
            $result = $connection->query($sql);
            
            if ($result) {
                $this->id = -1;
                return TRUE;
            } else {
                return FALSE;
            }
        }
        return TRUE;
    }
    
    public function login() {
        $_SESSION['user_id'] = $this->id;
    }
    
    public function logout() {
        unset($_SESSION['user_id']);
    }

    static public function loadUserById(mysqli $connection, $id) {

        $sql = "SELECT * FROM Users WHERE id=" . $id;

        $result = $connection->query($sql);

        if (($result == TRUE) && ($result->num_rows == 1)) {

            $row = $result->fetch_assoc();

            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            $loadedUser->email = $row['email'];

            return $loadedUser;
        }
        return NULL;
    }
    
    static public function loadUserByEmail(mysqli $connection, $email) {

        $sql = "SELECT * FROM Users WHERE email='" . $email . "'";

        $result = $connection->query($sql);

        if (($result == TRUE) && ($result->num_rows == 1)) {

            $row = $result->fetch_assoc();

            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashedPassword = $row['hashed_password'];
            $loadedUser->email = $row['email'];

            return $loadedUser;
        }
        return NULL;
    }

    static public function loadAllUsers(mysqli $connection) {

        $sql = "SELECT * FROM Users";
        $ret = [];

        $result = $connection->query($sql);

        if ($result == TRUE && $result->num_rows != 0) {
            
            foreach ($result as $row) {
                
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashedPassword = $row['hashed_password'];
                $loadedUser->email = $row['email'];
                
                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }

    //dodać metody login i logout
}
