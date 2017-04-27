<?php

session_start();

require_once '../src/User.php';
require_once '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    require_once '../config/connection.php';
    
    $allOK = TRUE;
    
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        $allOK = FALSE;
        $_SESSION['email_err'] = "<p class='text-danger'>Invalid email format</p>";
        
    } else {
        
        if (User::loadUserByEmail($conn, $_POST['email'])) {
            
            $allOK = FALSE;
            $_SESSION['email_err'] = "<p class='text-danger'>User with entered email already exists</p>";
            
        }
        
    }
    
//    if (($_POST['username'])) {
//        //dodać walidację!
//        $allOK = FALSE;
//        $_SESSION['username_err'] = "<p class='text-danger'>Use only alphanumeric characters</p>";
//        
//    }
    
    if (strlen($_POST['password']) < 8) {
        
        $allOK = FALSE;
        $_SESSION['password_err'] = "<p class='text-danger'>Use minimum eight characters</p>";
        
    }
    
    if ($_POST['password'] != $_POST['verif_passwd']) {
        
        $allOK = FALSE;
        $_SESSION['verif_passwd'] = "<p class='text-danger'>Given passwords are not identical</p>";
        
    }
    
    if ($allOK == TRUE) {
        
        $newUser = new User();
        $newUser->setEmail($email);
        $newUser->setUsername($_POST['username']);
        $newUser->setHashedPassword($_POST['password']);
        $newUser->saveToDB($conn);
        
        $newUser->login();
        
        header('Location: ../index.php');
        exit();
        
    }
    
}

require_once '../template/header.html';
$header = 'header.html';

?>

<div class="form-group jumbotron">
    <form action="register.php" method="POST">
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4">
                <input required type="email" class="form-control" name="email" placeholder="email">
            </div>
            <div class="col-xs-4"></div>
        </div>
        <?php 
        
            if (isset($_SESSION['email_err'])) {
                
                echo $_SESSION['email_err'];
                
            }
        
        ?>
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4">
                <input type="text" class="form-control" name="username" placeholder="username">
            </div>
            <div class="col-xs-4"></div>
        </div>
        <?php 
        
            if (isset($_SESSION['username_err'])) {
                
                echo $_SESSION['username_err'];
                
            }
        
        ?>
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4">
                <input type="password" class="form-control" name="password" placeholder="password">
            </div>
            <div class="col-xs-4"></div>
        </div>
        <?php 
        
            if (isset($_SESSION['password_err'])) {
                
                echo $_SESSION['password_err'];
                
            }
        
        ?>
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4">
                <input type="password" class="form-control" name="verif_passwd" placeholder="verify password">
            </div>
            <div class="col-xs-4"></div>
        </div>
        <?php 
        
            if (isset($_SESSION['verif_passwd'])) {
                
                echo $_SESSION['verif_passwd'];
                
            }
        
        ?>
        <div class="row">
            <div class="col-xs-4"></div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-default form-control">Sign up</button>
            </div>
            <div class="col-xs-4"></div>
        </div>
    </form>
</div>

<?php

require_once '../template/footer.html';
$footer = 'footer.html';