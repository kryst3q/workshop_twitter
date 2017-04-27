<?php

    session_start();

    require_once 'config/check_login.php';
    
    echo "Udało się";
    unset($_SESSION['user_id']);
    

