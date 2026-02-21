<?php

// connects to the database
require 'connect.php';

// this gets the id that auto increments since every task is assigned their own id in the database
$taskId = $_GET['id'];

// thsi creates the sql query to delete tasks with specific ids so not all tasks are deleted at the same time
$sql = "DELETE FROM tasks WHERE id = :id";

// this prepares the query
$stmt = $pdo->prepare($sql);

//this binds the id and taskId parameters to each other
$stmt->bindParam(':id', $taskId);

//executes the query
$stmt->execute();

//this redirects back to the viewtask file to update the table if anything was deleted
header("Location: viewtasks.php");

exit;
