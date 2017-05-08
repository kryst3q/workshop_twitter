<?php

session_start();

require_once '../config/check_login.php';
    
require_once '../template/header.html';
require_once '../template/navbar.html';
require_once '../src/Tweet.php';
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
            ?>
        </div>
    </div>
</div>

<?php

require_once '../template/footer.html';