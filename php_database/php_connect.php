<?php
    $host = 'localhost'; // ชื่อโฮสต์ฐาน
    $db   = 'it67040233103'; // ชื่อฐาน
    $pass = 'R7A8Z1W2';        // รหัสผ่านฐานข้อมูล
    $dbname = 'it67040233103';  // ชื่อฐานข้อมูล

    $conn = new mysqli($host, $db, $pass, $dbname);
    mysqli_set_charset($conn, "utf8");

    if (!$conn) {
        die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . mysqli_connect_error());
    }
?>