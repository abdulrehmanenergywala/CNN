<?php
$host = "localhost";
$db_user = "rsoa_rso211_41";
$db_pass = "123456";
$db_name = "rsoa_rso211_41";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB Connection failed: " . $e->getMessage());
}
?>
