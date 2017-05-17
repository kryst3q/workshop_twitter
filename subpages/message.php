<?php

session_start();

require_once '../template/header.html';
require_once '../template/navbar.html';
require_once '../template/messages_navbar.html';
require_once '../src/Message.php';
require_once '../config/connection.php';

unset($_SESSION['bad_input']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if ((preg_match('/^[a-z0-9 .\-]+$/i', $_POST['title'])) && (preg_match('/^[a-z0-9 .\-]+$/i', $_POST['message']))) {
        
        var_dump(Message::sendMessage($conn, $_POST['title'], $_POST['message'], $_SESSION['user_id'], (int)$_SESSION['recipient_id']));
        header('Location: sent_all.php');
        exit();
        
    } else {
        
        $_SESSION['bad_input'] = "<p class='text-danger'>You can type only alphanumeric, spaces, period and dashes</p>";
        
    }
    
}

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

                    echo "<div class='panel panel-default'>";
                    echo "<div class='panel-heading'><span class='text-muted'>Title: </span>" . $result->getTitle() . " <span class='text-muted'> || </span><span class='text-muted'>Author: </span>" . $result->getSendername() . "</div>";
                    echo "<div class='panel-body'>" . $result->getMessage() . "</div>";
                    echo "<div class='panel-footer'><span class='text-muted'>at </span><small>" . $result->getSendDatetime() . "</small></div>";
                    echo "</div>";

                    $_SESSION['recipient_id'] = $result->getSenderId();

                }

            ?>
            <div class="form-group" style="border-radius: 3px; padding: 10px; background-color: #f5f5f5; border: 1px solid #ddd">
                <div>
                    <?php 
                    
                        if (isset($_SESSION['bad_input'])) {

                            echo $_SESSION['bad_input'];

                        }
                    
                    ?>
                </div>
                <form action="message.php" method="POST">
                    <div class="input-group" style="margin-bottom: 10px">
                        <input required type="text" name="title" class="form-control" placeholder="Title">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default">Respond</button>
                        </span>
                    </div>
                    <textarea required name="message" class="form-control" placeholder="Response"></textarea>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

require_once '../template/footer.html';