<?php

require_once 'connection.php';
require_once 'src/User.php';

$user1 = new User();

$user1->setEmail("mail@domain.com");
$user1->setUsername("Jane Smith");
$user1->setHashedPassword("secretpass");

$user1->saveToDB($conn);
var_dump($user1);

$conn->close();
$conn = null;