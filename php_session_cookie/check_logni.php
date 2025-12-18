<?php
session_start();

if (!isset($_SESSION['username'])) {
    echo "กรุณาเข้าสู่ระบบก่อน";
} else {
    echo "ยินดีต้อนรับ " . $_SESSION['username'];
}
?>