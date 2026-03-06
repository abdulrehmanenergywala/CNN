<?php
session_start();
require 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid Article ID");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    die("Article not found!");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($article['title']); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">

    <h1><?php echo htmlspecialchars($article['title']); ?></h1>

    <img src="<?php echo htmlspecialchars($article['image']); ?>" width="100%" style="border-radius:10px; margin:15px 0;">

    <p style="color:#0ff;">
        Published: <?php echo $article['created_at']; ?>
    </p>

    <p style="line-height:1.8; margin-top:15px;">
        <?php echo nl2br(htmlspecialchars($article['content'])); ?>
    </p>
<?php if(isset($_SESSION['user_name'])): ?>
    <br>
    <a href="delete_article.php?id=<?php echo $article['id']; ?>" 
       onclick="return confirm('Are you sure you want to delete this article?');"
       style="color:red; border:2px solid red; padding:8px 15px; border-radius:8px; text-decoration:none;">
       Delete Article
    </a>
<?php endif; ?>
    <hr style="margin:40px 0; border-color:#222;">

    <h2>Related Articles</h2>

    <div class="grid">
    <?php
    $related = $conn->prepare("SELECT * FROM articles 
                               WHERE category_id = ? 
                               AND id != ? 
                               ORDER BY created_at DESC 
                               LIMIT 3");
    $related->execute([$article['category_id'], $id]);

    while ($row = $related->fetch(PDO::FETCH_ASSOC)):
    ?>
        <div class="card">
            <img src="<?php echo htmlspecialchars($row['image']); ?>" width="100%">
            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
            <a href="article.php?id=<?php echo $row['id']; ?>">Read More</a>
        </div>
    <?php endwhile; ?>
    </div>

</div>

<?php include 'footer.php'; ?>

</body>
</html>
