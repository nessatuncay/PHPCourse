<?php

require "connect.php";


/*this makes sure that it can get the id*/
if (!isset($_GET['id'])) {
    die("There is no task id");
}

$taskId = $_GET['id'];

/*this makes sure that if the form is submitted then the row will be updated*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /*this is to sanitize the data */
    $taskName  = trim($_POST['task_name'] ?? '');
    $category  = trim($_POST['category'] ?? '');
    $dueDate   = trim($_POST['due_date'] ?? '');
    $timeSpent = (int)($_POST['time_spent'] ?? 0);


    /*this is validating the info in a simple */
    if ($taskName === '' || $category === '' || $dueDate === '') {
        /*if task name, category and due date is emoty then it gives this error */
        $error = "The task name, category and due date is required";
    } else {
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

if (!$task) {
    die("Tasks has not been found");
}
?>

<!-- this is the html part -->
<main class="container mt-4">
    <h2>Update Tasks #<?= htmlspecialchars($task['id']); ?></h2>

    <?php if (!empty($error)): ?>
        <p class="text-danger"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="post">
        <h4 class="mt-3">Tasks Name</h4>

        <label class="form-label">Task Name</label>
        <input
            type="text"
            name="task_name"
            class="form-control mb-3"
            value="<?= htmlspecialchars($task['task_name']); ?>"
            required>

        <label class="form-label">Category/Priority</label>
        <select name="category" class="form-control mb-3" required>
            <option value="High" <?= $task['category'] === 'High' ? 'selected' : '' ?>>High</option>
            <option value="Medium" <?= $task['category'] === 'Medium' ? 'selected' : '' ?>>Medium</option>
            <option value="Low" <?= $task['category'] === 'Low' ? 'selected' : '' ?>>Low</option>
        </select>

        <label class="form-label">Due Date</label>
        <input
            type="text"
            name="due_date"
            class="form-control mb-3"
            value="<?= htmlspecialchars($task['due_date']); ?>"
            required>

        <label class="form-label">How Much Time Spent</label>
        <input
            type="number"
            name="time_spent"
            class="form-control mb-4"
            min="0"
            value="<?= (int)$task['time_spent']; ?>">

        <button class="btn btn-primary">Update Changes</button>
        <a href="viewtasks.php" class="btn btn-secondary">Cancel</a>









    </form>






</main>