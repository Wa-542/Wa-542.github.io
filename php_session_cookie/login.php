<?php
session_start();

if (isset($_POST["submit"])) {
    $_SESSION['username'] = $_POST["username"];
    header("Location: home.php");
}
?>

<form method="post">
    ชื่อผู้ใช้: <input type="text" name="username" required>
    <input type="submit" name="submit" value="Login">
</form>