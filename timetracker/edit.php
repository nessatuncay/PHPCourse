<?php

require "connect.php";


/*this makes sure that it can get the id*/ 
if (!isset($_GET['id']))
    {
        die("There is no task id");
    }

$taskId = $_GET['id'];

/*this makes sure that if the form is submitted then the row will be updated*/ 
if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        /*this is to sanitize the data */
        $taskName  = trim($_POST['task_name'] ?? '');
        $category  = trim($_POST['category'] ?? '');
        $dueDate   = trim($_POST['due_date'] ?? '');
        $timeSpent = (int)($_POST['time_spent'] ?? 0);


        /*this is validating the info in a simple */
        if ($taskName === '' || $category === '' || $dueDate === '')
            {
                /*if task name, category and due date is emoty then it gives this error */
                $error = "The task name, category and due date is required";
            }
        else
            {
                /*this updates the data in the database */
                $sql = "UPDATE tasks SET task_name = :task_name, category = :category, due date = :due_date, time_spent = :time_spent WHERE id = :id";

                $stmt = $pdo->prepare($sql);

                /*this binds the parameters*/
                $stmt->bindParam(':task_name', $taskName);
                $stmt->bindParam(':category', $category);
                $stmt->bindParam(':due_date', $dueDate);
                $stmt->bindParam(':time_spent', $timeSpent);
                $stmt->bindParam(':id', $taskId);

                $stmt->execute();

                exit;
            }
    }



    /*this loads the data that is already there */
    $sql = "SELECT * FROM, tasks WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $taskId);
    $stmt->execute();

    $task = $stmt->fetch();

    if (!$task)
        {
            die("Tasks has not been found");
        }
?>