<?php
session_start(); //เริ่มใช้งาน session

$_SESSION['username'] = 'student1'; 
$_SESSION['role'] = 'admin';

echo "สร้าง session เรียบร้อยแล้ว"; 
?>