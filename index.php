<?php

    session_start();

    require_once 'config/check_login.php';
    require_once 'config/connection.php';
    require_once 'src/Tweet.php';
    
    require_once 'template/header.html';
    require_once 'template/navbar.html';
    
    require_once 'template/tweet.html';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $newTweet = new Tweet();
        $newTweet->setUserId((int)$_SESSION['user_id']);
        $newTweet->setText($_POST['tweet']);
        $newTweet->setCreationDate(date('Y-m-d H:i:s'));
        $newTweet->saveToDB($conn);
        
    }
    
    foreach (Tweet::loadAllTweets($conn) as $tweet) {
        
        echo "<div class='panel panel-default'>";
        echo "<div class='panel-heading'><a href='userinfo.php?user_id=" . $tweet['user_id'] . "'>" . $tweet['username'] . "</a> <span class='text-muted'>wrote:</span></div>";
        echo "<a href='subpages/tweet.php?tweet_id=" . $tweet['id'] . "'><div class='panel-body'>" . $tweet['text'] . "</div></a>";
        echo "<div class='panel-footer'><span class='text-muted'>at </span><small>" . $tweet['creation_date'] . "</small></div>";
        echo "</div>";
        
    }
    
    require_once 'template/footer.html';