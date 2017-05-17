<?php 

session_start();

require_once '../template/header.html';
require_once '../template/navbar.html';
require_once '../src/User.php';
require_once '../src/Message.php';
require_once '../config/connection.php';

unset($_SESSION['recipient_err']);
unset($_SESSION['bad_input']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
    if ((preg_match('/^[a-z0-9 .\-]+$/i', $_POST['recipient'])) && (preg_match('/^[a-z0-9 .\-]+$/i', $_POST['title'])) && (preg_match('/^[a-z0-9 .\-]+$/i', $_POST['message']))) {
            
        if (User::ifUserExists($conn, $_POST['recipient']) != FALSE) {
        
            $user = User::loadUserByUsername($conn, $_POST['recipient']);
            if ($_SESSION['user_id'] == $user->getId()) {

                $_SESSION['recipient_err'] = "<p class='text-danger'>You can't send message to yourself!</p>";

            } else {

                Message::sendMessage($conn, $_POST['title'], $_POST['message'], $_SESSION['user_id'], User::ifUserExists($conn, $_POST['recipient']));
                header('Location: sent_all.php');
                exit();

            }
        
        } else {
        
            $_SESSION['recipient_err'] = "<p class='text-danger'>User doesn't exists</p>";
        
        }
        
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
            <div class="form-group" style="border-radius: 3px; padding: 10px; background-color: #f5f5f5; border: 1px solid #ddd">
                <div>
                    <?php 
                    
                        if (isset($_SESSION['bad_input'])) {

                            echo $_SESSION['bad_input'];

                        }
                    
                    ?>
                </div>
                <form action="send.php" method="POST">
                    <input required type="text" name="recipient" class="form-control" placeholder="Recipient" style="margin-bottom: 10px" 
                           value="<?php 
                                    if (isset($_GET['to'])) {

                                        $to = trim($_GET['to']);
                                        echo $to;

                                    }
                                ?>">
                    <?php 

                        if (isset($_SESSION['recipient_err'])) {

                            echo $_SESSION['recipient_err'];

                        }

                    ?>
                    <input required type="text" name="title" class="form-control" placeholder="Title" style="margin-bottom: 10px">
                    <div class="input-group">
                        <textarea required name="message" class="form-control" placeholder="Message" rows="3"></textarea>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-default" style="height: 84px">Send</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

require_once '../template/footer.html';