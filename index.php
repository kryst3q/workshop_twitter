<?php

    session_start();
    
    require_once 'config/check_login.php';
    require_once 'config/connection.php';
    require_once 'src/Tweet.php';
    
    require_once 'template/header.html';
    require_once 'template/navbar.html';
    
    require_once 'template/tweet.html';
    
    unset($_SESSION['bad_input']);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        if (preg_match('/^[a-z0-9 .\-]+$/i', $_POST['tweet'])) {
            
            $newTweet = new Tweet();
            $newTweet->setUserId((int)$_SESSION['user_id']);
            $newTweet->setText($_POST['tweet']);
            $newTweet->setCreationDate(date('Y-m-d H:i:s'));
            $newTweet->saveToDB($conn);
            
        } else {
            
            $_SESSION['bad_input'] = "<p class='text-danger'>You can type only alphanumeric, spaces, period and dashes</p>";
            
        }
        
    }
    
    if (isset($_SESSION['bad_input'])) {
        
        echo "<div>" . $_SESSION['bad_input'] . "</div>";
        
    }
    
    foreach (Tweet::loadAllTweets($conn) as $tweet) {
        
        echo "<div class='panel panel-default'>";
        echo "<div class='panel-heading'><a href='subpages/userinfo.php?user_id=" . $tweet->getuserId() . "'>" . $tweet->getUsername() . "</a> <span class='text-muted'>wrote:</span></div>";
        echo "<a href='subpages/tweet.php?tweet_id=" . $tweet->getId() . "'><div class='panel-body'>" . $tweet->getText() . "</div></a>";
        echo "<div class='panel-footer'><span class='text-muted'>at </span><small>" . $tweet->getCreationDate() . "</small></div>";
        echo "</div>";
        
    }
    
    require_once 'template/footer.html';