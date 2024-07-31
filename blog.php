<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Blog - Blog List</title>
    <link rel="stylesheet" href="blog.css">
</head>
<body>


    <header>
        <h1>Car Blog</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if ($_SESSION['user'] === 'admin') : ?>
                    <li><a href="admin.php">Create Blog</a></li>
                <?php endif; ?>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- <h2>All Blogs</h2> -->
        <div class="blog-list">
            <?php
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'car_blog');

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM blogs";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="blog-post">';
                    if (!empty($row['image_url'])) {
                        echo '<img src="' . $row['image_url'] . '" alt="Blog Image">';
                    }
                    echo '<h3><a href="post.php?id=' . $row['id'] . '">' . $row['title'] . '</a></h3>';
                    echo '<p>' . substr($row['content'], 0, 150) . '...</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No blogs found.</p>';
            }

            $conn->close();
            ?>
        </div>
    </main>
    
    <footer>
        <p>&copy; 2024 Car Blog. All rights reserved.</p>
    </footer>
</body>
</html>
