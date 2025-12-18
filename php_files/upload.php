<?php
$target_dir = "uploads/";

// สร้างโฟลเดอร์ถ้ายังไม่มี
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// ตรวจสอบ error จาก PHP
if ($_FILES["fileToUpload"]["error"] !== 0) {
    die("Upload error code: " . $_FILES["fileToUpload"]["error"]);
}

// ตรวจสอบว่าเป็นรูปจริง
$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
if ($check === false) {
    die("File is not an image");
}

// ตรวจสอบชนิดไฟล์
$ext = strtolower(pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION));
$allow = ["jpg", "jpeg", "png", "gif"];
if (!in_array($ext, $allow)) {
    die("Only JPG, JPEG, PNG, GIF allowed");
}

// ตรวจสอบขนาดไฟล์ (2MB)
if ($_FILES["fileToUpload"]["size"] > 2000000) {
    die("File too large");
}

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

// ย้ายไฟล์
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "Upload success<br><br>";
    echo "<img src='$target_file' width='250'>";
} else {
    echo "Upload failed";
}
?>
