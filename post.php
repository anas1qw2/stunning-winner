<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'car_blog');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT * FROM blogs WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    header('Location: blog.php');
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Blog - <?php echo $post['title']; ?></title>
    <link rel="stylesheet" href="post.css">
</head>
<body>
    <header>
        <h1>Car Blog</h1>
        <nav>
            <ul>
                <li><a href="blog.php">Back to Blogs</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <article>
            <h2><?php echo $post['title']; ?></h2>
            <?php if ($post['image_url']) : ?>
                <img src="<?php echo $post['image_url']; ?>" alt="<?php echo $post['title']; ?>">
            <?php endif; ?>
            <p><?php echo $post['content']; ?></p>
        </article>
    </main>

    <footer>
        <p>&copy; 2024 Car Blog. All rights reserved.</p>
    </footer>
</body>
</html>
