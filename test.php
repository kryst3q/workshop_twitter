<?php

session_start();

require_once 'config/connection.php';
require_once 'src/User.php';
require_once 'vendor/autoload.php';

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

//$faker = Faker\Factory::create();
//
//for ($i=0; $i < 9; $i++) {
//    
//    $dateFull=$faker->dateTimeThisYear($max = 'now', $timezone = date_default_timezone_get());
//    $fakeDate = $dateFull->format('Y-m-d H:i:s.u');
//    $query1 = "INSERT INTO Tweets (user_id, tweet, send_datetime) VALUES (" . rand(5, 9) . ", '" . $faker->text($maxNbChars = 140) . "', '" . $fakeDate . "')";
//    $conn->query($query1);
//    
//    $query = "INSERT INTO Messages (title, message, sender_id, recipient_id, status, send_datetime) VALUES ('Title 1$i', '" . $faker->text($maxNbChars = 140) . "', 5, " . rand(6, 9) . ", 0, NOW())" ;
//    $conn->query($query);
//    var_dump($query);
//}

//var_dump(User::ifUserExists($conn, 'Jane Smith'));


//$conn->close();
//$conn = null;