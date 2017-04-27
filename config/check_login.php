<?php

if (!isset($_SESSION['user_id'])) {
    
    header("Location: ./subpages/login.php");
    exit();
    
}

