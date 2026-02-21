<?php include 'connect.php'; ?>

<head>
    <title>Add Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body>
    <main>
        <h2>Add Task</h2>
        <form action="process.php" method="post"> <!-- This creates the form and takes the query info from the process file -->
            <fieldset>
                <legend>Task Information</legend>

                <!-- User inputs the task name here -->
                <label for="task_name" class="form-label">Task Name</label>
                <input type="text" id="task_name" name="task_name" class="form-control">

                <!-- User chooses which catgeory the task priority falls into -->
                <label for="category" class="form-label">Priority</label>
                <select id="category" name="category" class="form-control">
                    <option value="High">High Priority</option>
                    <option value="Medium">Medium Priority</option>
                    <option value="Low">Low Priority</option>
                </select>

                <!-- TUser inputs the due date in here and makes sure the date is in the YYYY-MM-DD format -->
                <label for="due_date" class="form-label">Due Date</label>
                <input type="text" id="due_date" name="due_date" placeholder="YYYY-MM-DD" class="form-control">

                <!-- This keeps track of the time that has been spent on the task -->
                <label for="time_spent" class="form-label">Time Spent</label>
                <input type="number" id="time_spent" name="time_spent" class="form-control" min="1">
            </fieldset>

            <!-- Its the submit button to add the task -->
            <p>
                <button type="submit">Add Task</button>
            </p>

        </form>
    </main>
</body>

</html>