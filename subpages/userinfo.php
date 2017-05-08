<?php

    session_start();

    require_once '../config/check_login.php';
    require_once '../config/connection.php';
    require_once '../src/Tweet.php';
    require_once '../src/User.php';
    
    require_once '../template/header.html';
    require_once '../template/navbar.html';
    
    if (($_SERVER['REQUEST_METHOD'] == 'GET') && (isset($_GET['user_id']))) {
        
        $userId = (int)$_GET['user_id'];
        
        if (is_int($userId)) {
            
            $user = User::loadUserById($conn, $userId);
            
            echo "<div class='panel panel-default'>";
            echo "<div class='panel-heading'></div>";
            echo "<div class='panel-body'>Username: " . $user->getUsername() . "</div>";
            echo "<div class='panel-body'>E-mail: " . $user->getEmail() . "</div>";
            echo "<div class='panel-footer'></div>";
            echo "</div>";
        
        }
        
    } else {
        
        header('Location: ../index.php');
        
    }

    require_once '../template/footer.html';

