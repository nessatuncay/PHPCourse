<?php

require "connect.php";

session_start();

/*these are to store validation errors and successes*/
$errors = [];
$success = "";

/*this sees if the form was submitted with post or not*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    /*this gets and sanitizes the username, email and passwords */
    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    /*server side validation begins from here */



    /*this checks if the input areas are blank and gives errors if they are */
    if ($username === '' || $email === '' || $password === '' || $confirm === '') {
        $errors[] = "Fill in all fields";
    }
    /*this checks if the password matches the confirmed password*/ elseif ($password !== $confirmPassword) {
        $errors[] = "Passwords dont match";
    }


    if (empty($errors)) {
        /*this checks if the username or email is already in the database so it can reject registering*/
        $sql = "SELECT * FROM users WHERE username = :username OR email = :email";

        /*this prepares the sql statement with pdo, binds the input to the database attributes and then executes it */
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();


        /*this gives an error message if the username or email already exists in the database */
        if ($stmt->fetch()) {
            $errors[] = "Username or email is already being used";
        }
    }


    /*time to insert the new user into the database */
    if (empty($errors)) {
        /*this hashes the password befor putting it in the database and makes sure the password isnt readable by people */
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";


        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        $stmt->execute();

        $success = "You have registered now you can log in";
    }
}
?>


<!-- this is the html part of it-->
<main class="container mt-4">
    <h2>Register</h2>

    <!-- this shows if errors exist-->
    <?php if (!empty($errors)): ?>
        <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    <?php endif; ?>


    <!-- this shows if registering was succesful-->
    <?php if ($success !== ""): ?>
        <?= htmlspecialchars($success); ?>
        <a href="login.php" class="btn btn-sm btn-success mt-2">Login</a>
    <?php endif; ?>



    <!-- this is the actual form that will be filled out-->
    <form method="post" class="mt-3">

        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control mb-3" value="<?= htmlspecialchars($username ?? ''); ?>" required>

        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control mb-3" value="<?= htmlspecialchars($email ?? ''); ?>" required>

        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control mb-3" required>

        <label class="form-label">Confirm Password</label>
        <input type="password" name="confirm_password" class="form-control mb-3" required>

        <button class="btn btn-primary">Register</button>

        <a href="login.php" class="btn btn-secondary">Login</a>

    </form>
</main>