<?php

$host = 'localhost';
$username = 'root';
$passwd = 'coderslab';
$dbname = 'Twitter';

$conn = new mysqli($host, $username, $passwd, $dbname);

if ($conn->connect_error) {
    die("Błąd: " . $conn->connect_error);
}

