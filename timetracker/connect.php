<?php

$host = "localhost"; //this is the host name
$db = "timetracker"; // this is the name of the database
$user = "root";  //this is the usernme
$password = "";  // this is the password


$dsn = "mysql:host=$host;dbname=$db"; //this points to the database


try 
{
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) 
{
    die("Database connection failure: " . $e->getMessage());
}