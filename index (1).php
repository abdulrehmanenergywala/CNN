<?php
session_start();
require 'db.php';

/* Validate Category ID */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid Category!");
}

$cat_id = intval($_GET['id']);

/* Get Category Name */
$stmt = $conn->prepare("SELECT * FROM categories WHERE id = ?");
$stmt->execute([$cat_id]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    die("Category not found!");
}

/* Get Articles in this Category */
$articles = $conn->prepare("SELECT * FROM articles WHERE category_id = ? ORDER BY created_at DESC");
$articles->execute([$cat_id]);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($category['name']); ?> - CNN Clone</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">

    <h1 style="
        background: linear-gradient(90deg,#0ff,#f0f,#0ff);
        -webkit-background-clip:text;
        color:transparent;
        text-align:center;
        margin-bottom:30px;">
        <?php echo htmlspecialchars($category['name']); ?> News
    </h1>

    <div class="grid">

    <?php if($articles->rowCount() > 0): ?>
        
        <?php while($row = $articles->fetch(PDO::FETCH_ASSOC)): ?>
            
            <div class="card">
                <img src="<?php echo htmlspecialchars($row['image']); ?>" 
                     alt="Article Image" 
                     width="100%">

                <div style="padding:15px;">
                    <h3><?php echo htmlspecialchars($row['title']); ?></h3>

                    <p style="margin-top:10px;">
                        <?php echo htmlspecialchars($row['description']); ?>
                    </p>

                    <a href="article.php?id=<?php echo $row['id']; ?>">
                        Read More
                    </a>
                </div>
            </div>

        <?php endwhile; ?>

    <?php else: ?>
        <p style="text-align:center; color:#0ff;">
            No articles found in this category.
        </p>
    <?php endif; ?>

    </div>

</div>

<?php include 'footer.php'; ?>

</body>
</html>