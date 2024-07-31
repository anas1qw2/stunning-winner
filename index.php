<?php
session_start();

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check credentials
    if ($username === 'anas' && $password === 'anas123') {
        $_SESSION['user'] = 'admin';
        header('Location: blog.php');
        exit();
    } elseif ($username === 'user' && $password === 'user123') {
        $_SESSION['user'] = 'user';
        header('Location: blog.php');
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Blog - Login</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Welcome to the Car Blog</h1>
        </div>
    </header>

    <main>
        <div class="login-container">
            <h2>Login</h2>
            <?php if (isset($error)) : ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="post" action="">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Car Blog. All rights reserved.</p>
    </footer>
</body>
</html>
