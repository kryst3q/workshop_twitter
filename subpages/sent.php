<?php

session_start();

require_once '../template/header.html';
require_once '../template/navbar.html';
require_once '../template/messages_navbar.html';
require_once '../src/Message.php';
require_once '../config/connection.php';

?>

<div class="container">
    <div class="row">
        <?php 
            require_once '../template/messages_navbar.html';
        ?>
        <div class="col-md-10">
            <?php 

                if (($_SERVER['REQUEST_METHOD'] == 'GET') && (isset($_GET['id']))) {

                    $result = Message::getMessageById($conn, $_GET['id']);
                    $message = $result->fetch_assoc();

                    echo "<div class='panel panel-default'>";
                    echo "<div class='panel-heading'><span class='text-muted'>Title: </span>" . $message['title'] . " <span class='text-muted'> || </span><span class='text-muted'>Recipient: </span>" . $message['recipient'] . "</div>";
                    echo "<div class='panel-body'>" . $message['message'] . "</div>";
                    echo "<div class='panel-footer'><span class='text-muted'>at </span><small>" . $message['send_datetime'] . "</small></div>";
                    echo "</div>";

                }

            ?>
        </div>
    </div>
</div>

<?php

require_once '../template/footer.html';

