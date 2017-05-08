<?php

    session_start();

    require_once '../config/check_login.php';
    require_once '../config/connection.php';
    require_once '../src/Tweet.php';
    require_once '../src/User.php';
    
    require_once '../template/header.html';
    require_once '../template/navbar.html';
    
    if (($_SERVER['REQUEST_METHOD'] == 'GET') && (isset($_GET['tweet_id']))) {
        
        $tweetId = (int)$_GET['tweet_id'];
        
        if (is_int($tweetId)) {
            
            $tweet = Tweet::loadTweetById($conn, $tweetId);
            
            $user = User::loadUserById($conn, $tweet->getuserId());
            
            echo "<div class='panel panel-default'>";
            echo "<div class='panel-heading'><a href='userinfo.php?user_id=" . $tweet->getuserId() . "'>" . $user->getUsername() . "</a> <span class='text-muted'>wrote:</span></div>";
            echo "<div class='panel-body'>" . $tweet->getText() . "</div>";
            echo "<div class='panel-footer'><span class='text-muted'>at </span><small>" . $tweet->getCreationDate() . "</small></div>";
            echo "</div>";
            
        }
        
        
        
    } else {
        
        header('Location: ../index.php');
        
    }

    require_once '../template/footer.html';