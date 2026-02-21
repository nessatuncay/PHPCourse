<!DOCTYPE html>
<html>
<?php require "connect.php"; //this is to connect to the database 

//this gets all the tasks to be able to view it
$sql = "SELECT * FROM tasks";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$tasks = $stmt->fetchAll();

?>

<head>
    <title>View Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container"> <!-- Created a div conatiner -->
        <h2>All Tasks</h2>

        <!-- Creates a table to view -->
        <table border="1" cellpadding="8" cellspacing="0" class="table">
            <thead>
                <tr>
                    <th scope="col">Task Name</th>
                    <th scope="col">Priority</th>
                    <th scope="col">Due Date</th>
                    <th scope="col">Time Spent</th>
                </tr>
            </thead>

            <!-- This is to attach the info to the table above -->
            <?php foreach ($tasks as $task) : ?>
                <tr>
                    <td><?php echo $task['task_name']; ?></td>
                    <td><?php echo $task['category']; ?></td>
                    <td><?php echo $task['due_date']; ?></td>
                    <td><?php echo $task['time_spent']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $task['id']; ?>">Edit</a>
                        <a href="delete.php?id=<?php echo $task['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>

    </div>
</body>

</html>