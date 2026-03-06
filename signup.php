<?php
session_start();
require 'db.php';
 
if(isset($_POST['signup'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
 
    $stmt = $conn->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");
    if($stmt->execute([$name,$email,$password])){
        $_SESSION['user_name'] = $name;
        header("Location:index.php");
    } else {
        $error = "Signup failed!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'navbar.php'; ?>
<div class="container">
    <h2>Signup</h2>
    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <input type="text" name="name" placeholder="Full Name" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit" name="signup">Signup</button>
    </form>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
