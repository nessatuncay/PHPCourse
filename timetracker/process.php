<?php

require "connect.php"; //conect to database and create new pdo

if ($_SERVER['REQUEST_METHOD'] !== 'POST') 
{
    die('Invalid request');
}

//these is for accessing the data and to sanitize the input
$taskName = filter_input(INPUT_POST, 'task_name', FILTER_SANITIZE_SPECIAL_CHARS);
$category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
$dueDate = filter_input(INPUT_POST, 'due_date', FILTER_SANITIZE_SPECIAL_CHARS);
$timeSpent = filter_input(INPUT_POST, 'time_spent', FILTER_SANITIZE_NUMBER_INT);

//this is for server side validation
$errors = [];


//task name is required 
if ($taskName === null || $taskName === '') 
{
    $errors[] = "Task Name is required.";
}

//category is required
if ($category === null || $category === '') 
{
    $errors[] = "Category is required.";
}

//due date is required
if ($dueDate === null || $dueDate === '') 
{
    $errors[] = "Due Date is required.";
}

//the time spent is required and must be a posiitive integer and more than 0
if ($timeSpent === null || $timeSpent === '') 
{
    $errors[] = "Time Spent is required.";
} 
elseif (!filter_var($timeSpent, FILTER_VALIDATE_INT) || $timeSpent < 0) 
{
    $errors[] = "Time Spent must be a positive integer.";
}


//if there are errors then show the errors and stop script
if (!empty($errors)) 
{
    foreach ($errors as $error) 
    {
        echo "<p>$error</p>";
    }
    exit;
}




//setting up the query
$sql = "INSERT INTO tasks (task_name, category, due_date, time_spent) VALUES (:task_name, :category, :due_date, :time_spent)";

//preparing the query
$stmt = $pdo->prepare($sql);

//binding the parametres
$stmt->bindParam(':task_name', $taskName);
$stmt->bindParam(':category', $category);
$stmt->bindParam(':due_date', $dueDate);
$stmt->bindParam(':time_spent', $timeSpent);

//execute the query
$stmt->execute();

?> 

<main> 
    <h2>Task Added Successfully!</h2> 
    <p>You have added: <strong><?php echo $taskName; ?></strong></p> 
</main>

