<?php

session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require "../config/database.php";
    $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

    <title>Dashboard</title>
</head>

<body>
    <h1>Dashboard</h1>
    <?php if (isset($user)): ?>
        <p>Hello <?php echo htmlspecialchars($user["name"]); ?></p>
        <p><a href="logout.php">Log out</a></p>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Published Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Sample data
                $articles = [
                    ['title' => 'Article 1', 'author' => 'Author 1', 'published_date' => '2023-01-01'],
                    ['title' => 'Article 2', 'author' => 'Author 2', 'published_date' => '2023-02-01'],
                    // Add more articles as needed
                ];

                foreach ($articles as $article) {
                    echo "<tr>";
                    echo "<td>{$article['title']}</td>";
                    echo "<td>{$article['author']}</td>";
                    echo "<td>{$article['published_date']}</td>";
                    echo "<td><a href='#'>Edit</a> | <a href='#'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You are not logged in. <a href="login.php">Login</a></p>
    <?php endif; ?>

</body>

</html>