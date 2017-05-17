<?php

session_start();

require_once '../config/check_login.php';
    
require_once '../template/header.html';
require_once '../template/navbar.html';
require_once '../src/Tweet.php';
require_once '../src/Comment.php';
require_once '../src/User.php';
require_once '../config/connection.php';

?>

<div class="container">
    <div class="row">
        <?php 
            require_once '../template/account_navbar.html';
        ?>
        <div class="col-md-10">
            <?php
                $tweetId = (int)$_GET['tweet_id'];
                $myTweet = Tweet::loadTweetById($conn, $tweetId);
                
                echo "<div class='panel panel-default'>";
                echo "<div class='panel-body'>" . $myTweet->getText() . "</div>";
                echo "<div class='panel-footer'><span class='text-muted'>at </span><small>" . $myTweet->getCreationDate() . "</small></div>";
                echo "</div>";
                
                $comments = Comment::loadAllCommentsByPostId($conn, $tweetId);
                
                if ($comments != null) {
                    
                    foreach ($comments as $row) {
                    
                    $userComment = User::loadUserById($conn, $row->getUserId());
                    
                    echo "<div style='border: 1px solid #ddd; border-radius: 3px; padding: 10px; margin-bottom: 5px;'>";
                    echo "<a href='userinfo.php?user_id=" . $userComment->getId() . "'>" . $userComment->getUsername() . "</a> <span style='color: #777'>commented:</span><br>";
                    echo $row->getText();
                    echo "</div>";
                
                    }
                    
                }
                
            ?>
        </div>
    </div>
</div>

<?php

require_once '../template/footer.html';