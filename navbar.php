<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar">
    <div class="logo">CNN Clone</div>

    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="category.php?id=1">World</a></li>
        <li><a href="category.php?id=2">Sports</a></li>
        <li><a href="category.php?id=3">Technology</a></li>
        <li><a href="category.php?id=4">Entertainment</a></li>

        <?php if(isset($_SESSION['user_name'])): ?>
            <li><a href="add_article.php">Add Article</a></li>
            <li><a href="#">Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?></a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Signup</a></li>
        <?php endif; ?>
    </ul>

</nav>
