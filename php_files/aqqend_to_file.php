<?php
$filename = "newfile.txt";

// เปิดไฟล์แบบต่อท้าย
$text = "สมชาย" .date ("Y-m-d H:i:s") . PHP_EOL;


file_put_contents($filename, $text, FILE_APPEND);

echo "เขียนข้อมูลต่อท้ายไฟล์เรียบร้อย";
?>
