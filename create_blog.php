<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    $image_temp = $_FILES['image']['tmp_name'];
    
    // Move the uploaded file to the 'images' directory
    if ($image) {
        $target_dir = 'images/';
        $target_file = $target_dir . basename($image);
        move_uploaded_file($image_temp, $target_file);
    }

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'car_blog');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO blogs (title, content, image_url) VALUES ('$title', '$content', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        header('Location: blog.php');
        exit();
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Blog - Create Blog</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <h1>Create Blog</h1>
        <nav>
            <ul>
                <li><a href="blog.php">Back to Blogs</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="login-container">
            <h2>Create Blog</h2>
            <?php if (isset($error)) : ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="post" action="" enctype="multipart/form-data">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>

                <label for="content">Content:</label>
                <textarea id="content" name="content" required></textarea>

                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>

                <button type="submit">Create</button>
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Car Blog. All rights reserved.</p>
    </footer>
</body>
</html>
