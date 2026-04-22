<?php

require "connect.php";

session_start();

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        /*same old same old */
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') 
            {
                $error = "Username and password are required";
            } 
        else 
            {
                /*this gets the username from the database and see if it exists */
                $sql = "SELECT * FROM users WHERE username = :username";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->execute();

                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                /*this makes sure the password connected to the username and the password that is input are the same */
                if ($user && password_verify($password, $user['password'])) 
                    {
                        session_regenerate_id(true);

                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['username'] = $user['username'];

                        exit;
                    }  
                else 
                    {
                        $error = "Wrong username or password";
                    }
            }
    }

?>

<main class="container mt-4">
    <h2>Login</h2>

    <?php if ($error !== ""): ?>
        <?= htmlspecialchars($error); ?>
    <?php endif; ?>

    <form method="post">

        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control mb-3" required>

        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control mb-3" required>

        <button class="btn btn-primary">Login</button>
        <a href="register.php" class="btn btn-link">Register</a>

    </form>
</main>