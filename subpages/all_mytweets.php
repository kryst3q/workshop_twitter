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
            
                $userId = (int)$_SESSION['user_id'];
            
                foreach (Tweet::loadAllTweetsByUserId($conn, $userId) as $tweet) {

                    echo "<a href='mytweet.php?tweet_id=" . $tweet->getId() . "'><div class='panel panel-default'>";
                    echo "<div class='panel-body'>" . $tweet->getText() . "</div></a>";
                    echo "<div class='panel-footer' style='color: #777'>Comments: " . Tweet::getNoOfComments($conn, $tweet->getId()) . "</div>";
                    echo "</div>";

                }
            
            ?>
        </div>
    </div>
</div>

<?php

require_once '../template/footer.html';

