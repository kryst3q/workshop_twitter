<?php

session_start();

require_once 'config/connection.php';
require_once 'src/User.php';

//$user1 = new User();
//
//$user1->setEmail("mail@yahoo.com");
//$user1->setUsername("Janusz Austin");
//$user1->setHashedPassword("secretpass");
//
//$user1->saveToDB($conn);
//var_dump($user1);

//$user2 = User::loadUserById($conn, 1);
//var_dump($user2);
//if ($user2->delete($conn)) {
//    echo "Usunięto użytkownika";
//} else {
//    echo "Nie usunięto użytkownika";
//}

//$user2->setUsername('Mikołaj Smith');
//$user2->saveToDB($conn);
//
//$user3 = User::loadAllUsers($conn);
//var_dump($user3);

//$user = User::loadUserByEmail($conn, 'mail@domain.com');
//var_dump($user);
if (TRUE) {
    $_SESSION['test'] = "test";
}

header('Location: test2.php');

$conn->close();
$conn = null;