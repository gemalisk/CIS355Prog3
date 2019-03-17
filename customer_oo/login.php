<?php
session_start();
require "../database/database.php";

if($_GET) $errorMessage = $_GET['errorMessage'];
else $errorMesage = '';

if($_POST) {
    $success = false;
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM customers WHERE email = '$username' AND password_hash = '$password' LIMIT 1";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    
    if($data) {
        $_SESSION["username"] = $username;
        header("Location: customer.php");
    }
    else {
        header("Location: login.php?errorMessage=Invalid Credentials");
        exit();
    }
}
?>

<h1>Log In</h1>
<form class="form-horizontal" action="login.php" method="post">
    
    <input name="username" type="text"  placeholder="email@email.com" required>
    <input name="password" type="password" required>
    <button type="submit" class="btn btn-success">Sign in</button>
    <button onclick="location.href = 'logout.php';">Log Out</button>
    <button onclick="location.href = 'signup.php';">Sign Up</button>
    
    <p style='color: red;'><?php if (isset($errorMessage)) {echo $errorMessage;}?></p>
    
</form>