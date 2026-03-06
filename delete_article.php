<?php
session_start();
require 'db.php';

/* Only logged-in users can delete */
if (!isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}

/* Validate ID */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid Article ID");
}

$id = intval($_GET['id']);

/* Delete Article */
$stmt = $conn->prepare("DELETE FROM articles WHERE id = ?");
if ($stmt->execute([$id])) {
    header("Location: index.php?deleted=success");
    exit();
} else {
    die("Failed to delete article");
}
?>
