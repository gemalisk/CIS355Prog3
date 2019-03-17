<?php
session_start();
if (!$_SESSION) {
    header("Location: login.php");
}
require "../database/database.php";
require "customer.class.php";

if($_GET) $errorMessage = $_GET['errorMessage'];
else $errorMesage = '';

if($_POST) {
    $cust = new Customer();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cust = new Customer();

    if(isset($_POST["username"]) AND isset($_POST["password"]) ) {
        $cust->email = $_POST["username"];
        $cust->password_hash = $_POST["password"];
        $cust->mobile = 'default';
        $cust->name = 'default';
        $cust->insert_db_record();
    }
}
?>

<h1>Sign Up</h1>
<form class="form-horizontal" action="signup.php" method="post">
    
    <input name="username" type="text"  placeholder="me@email.com" required>
    <input name="password" type="password" required>
    <button type="submit" class="btn btn-success">Sign Up</button>
    
    <p style='color: red;'><?php if (isset($errorMessage)) {echo $errorMessage;}?></p>
    
</form>