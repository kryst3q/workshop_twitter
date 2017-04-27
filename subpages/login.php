<?php
    
    session_start();

    if (isset($_SESSION['user_id'])) {
        
        header('Location: ../index.php');
        
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        require_once '../config/connection.php';
        require_once '../src/User.php';
        
        $login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
        $user = User::loadUserByEmail($conn, $login);
        
        if ($user != NULL) {
            
            $hash = $user->getHashedPassword();
            
            $conn->close();
            $conn = NULL;
            
            if (password_verify($_POST['password'], $hash)) {
                
                $user->login();
                header('Location: ../index.php');
                exit();
                
            } else {
                
                $_SESSION['passwd_err'] = "<span class='text-danger'>Incorrect password!</span>";
                
            }
            
        } else {
            
            $_SESSION['login_err'] = "<span class='text-danger'>Given User doesn't exist!</span>";
            
        }
        
    }

    require '../template/header.html';
    $header = 'header.html';

?>

<div class="form-group">
    <form action="login.php" method="POST">
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="input-group col-xs-4">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input class="form-control" type="text" name="login" placeholder="Enter email">
            </div>
            <?php 
            
                    if (isset($_SESSION['login_err'])) {
                        
                        echo $_SESSION['login_err'];
                        
                    }
                
            ?>
            <div class="col-xs-4"></div>
        </div>
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="input-group col-xs-4">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input class="form-control" type="password" name="password" placeholder="Enter password">
            </div>
            <?php 
                
                    if (isset($_SESSION['passwd_err'])) {
                        
                        echo $_SESSION['passwd_err'];
                        
                    }
                
            ?>
            <div class="col-xs-4"></div>
        </div>
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-default form-control">Log in</button>
            </div>
            <div class="col-xs-4"></div>
        </div>
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4">
                <p>Don't have an account? <a href="register.php">Sign up!</a></p>
            </div>
            <div class="col-xs-4"></div>
        </div>
    </form>
</div>

<?php

    require '../template/footer.html';
    $header = 'footer.html';

