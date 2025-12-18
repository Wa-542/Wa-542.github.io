<?php
//ตรวจสอบว่ามีการส่งข้อมูลผู้ใช้มาหรือไม่
if (isset($_POST["submit"])) {
    //รับข้อมูลจากฟอร์ม
    $username = $_POST["username"];

    //กำหนด Cookie  ชื่อ "user" ด้วยข้อมูล username
    setcookie("user", $username, time() + 3600,"/");

}
// ตรวจสอบว่ามี Cookie หรือไม่
if (isset($_COOKIE["user"])) {
    $welcome_message = "ยินดีตอนรับ" . $_COOKIE["user"] . "!";
} else {
    $welcome_message = "Welcome, Guest!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Cookie Example</title>
</head>
<body>
    <h1><?php echo $welcome_message; ?></h1>

    <form method="post" action="">
        <label for="username">ชื่อผู้ใช้:</label>
        <input type="text" id="username" name="username">
        <input type="submit" name="submit"></button>
    </form>

</body>
</html>