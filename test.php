<?php

session_start();

require_once 'config/connection.php';
require_once 'src/User.php';
require_once 'src/Comment.php';
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
//for ($i=0; $i < 20; $i++) {
//    
//    $dateFull=$faker->dateTimeThisYear($max = 'now', $timezone = date_default_timezone_get());
//    $fakeDate = $dateFull->format('Y-m-d H:i:s.u');
//    $query1 = "INSERT INTO Tweets (user_id, tweet, send_datetime) VALUES (" . rand(5, 9) . ", '" . $faker->text($maxNbChars = 140) . "', '" . $fakeDate . "')";
//    $conn->query($query1);
//    
//    $query = "INSERT INTO Comments (text, tweet_id, user_id, creation_date) VALUES ('" . $faker->text($maxNbChars = 60) . "'," . rand(1, 61) . ", " . rand(5, 9) . ", '" . $fakeDate . "')" ;
//    $conn->query($query);
//    var_dump($query);
//}

//var_dump(User::ifUserExists($conn, 'Jane Smith'));

//$comments = Comment::loadAllCommentsByPostId($conn, 40);
//var_dump($comments);
//
//$comment = Comment::loadCommentById($conn, 20);
//var_dump($comment);
//
//$conn->close();
//$conn = null;