<?php
session_start();
require 'db.php';

/* Only logged-in users can access */
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}

$message = "";

/* Handle Form Submission */
if (isset($_POST['submit'])) {

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $content = trim($_POST['content']);
    $image = trim($_POST['image']);
    $category_id = intval($_POST['category']);

    if ($title && $description && $content && $image && $category_id) {

        $stmt = $conn->prepare("INSERT INTO articles (title, description, content, image, category_id) VALUES (?, ?, ?, ?, ?)");
        
        if ($stmt->execute([$title, $description, $content, $image, $category_id])) {
            $message = "✅ Article Added Successfully!";
        } else {
            $message = "❌ Failed to Add Article!";
        }

    } else {
        $message = "❌ Please fill all fields!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Article - CNN Clone</title>
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
        Add New Article
    </h1>

    <?php if($message): ?>
        <p style="text-align:center; color:#0ff;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">

        <input type="text" name="title" placeholder="Article Title" required><br><br>

        <textarea name="description" placeholder="Short Description" rows="3" required></textarea><br><br>

        <textarea name="content" placeholder="Full Content" rows="8" required></textarea><br><br>

        <input type="text" name="image" placeholder="Image URL (https://...)" required><br><br>

        <select name="category" required>
            <option value="">Select Category</option>
            <?php
            $cats = $conn->query("SELECT * FROM categories");
            while ($cat = $cats->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='".$cat['id']."'>".$cat['name']."</option>";
            }
            ?>
        </select><br><br>

        <button type="submit" name="submit">Publish Article</button>

    </form>

</div>

<?php include 'footer.php'; ?>

</body>
</html>
