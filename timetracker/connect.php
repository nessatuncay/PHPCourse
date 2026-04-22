<?php

$host = "sql100.infinityfree.com"; //this is the host name
$db = "if0_41723509_timetracker"; // this is the name of the database
$user = "if0_41723509";  //this is the usernme
$password = "Folley4ever";  // this is the password


$dsn = "mysql:host=$host;dbname=$db"; //this points to the database


try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failure: " . $e->getMessage());
}
