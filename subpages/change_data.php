<?php

session_start();

require_once '../config/check_login.php';
    
require_once '../template/header.html';
require_once '../template/navbar.html';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once '../config/connection.php';
    require_once '../src/User.php';

    $allOK = TRUE;

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
        $newUser->setHashedPassword($_POST['password']);
        $newUser->saveToDB($conn);

        $newUser->login();

        header('Location: account.php');
        exit();
    }
}
?>

<div class="container">
    <div class="row">
        <?php
        require_once '../template/account_navbar.html';
        ?>
        <div class="col-md-10">
            
                <form action="account.php" method="POST"class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="password">New password:</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="password" placeholder="type new password">
                        </div>
                        <?php
                        if (isset($_SESSION['password_err'])) {

                            echo $_SESSION['password_err'];
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="verify">Verify password:</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="verif_passwd" id="verify" placeholder="verify new password">
                        </div>
                        <?php
                        if (isset($_SESSION['verif_passwd'])) {

                            echo $_SESSION['verif_passwd'];
                        }
                        ?>
                    </div>
<!--                    <div class="form-group">
                        <label class="control-label col-sm-2" for="about">About You:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="about" id="about" placeholder="tell something about you"></textarea>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <span class="col-sm-2" for="span"></span>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-default form-control">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

require_once '../template/footer.html';