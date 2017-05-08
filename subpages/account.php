<?php

session_start();

require_once '../config/check_login.php';
    
require_once '../template/header.html';
require_once '../template/navbar.html';

?>

<div class="container">
    <div class="row">
        <?php 
            require_once '../template/account_navbar.html';
        ?>
        <div class="col-md-10">
            user data
        </div>
    </div>
</div>

<?php

require_once '../template/footer.html';