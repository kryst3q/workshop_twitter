<?php

session_start();

require_once '../config/connection.php';
require_once '../src/User.php';

$user = User::loadUserById($conn, $_SESSION['user_id']);
$user->logout();

$conn->close();
$conn = NULL;

header('Location: login.php');

