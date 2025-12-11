<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Buit-in Functions ฟังก์ชันที่มีพร้องใช้งาน</title>
</head>
<body>
    <h1>PHP Buit-in Functions ฟังก์ชันที่มีพร้องใช้งาน</h1>
    <h2>ทดสอบการใช้ Functions date </h2>
    <?php
    echo "วันนี้วันที่" . date("d/m/y"). "<br>";
    echo "เวลาปัจจุบัน " . date("H:i:s"). "<br>";
    echo "วันนี้เป็นวัน" . date("l");
    ?>
    <h1>ทดสอบการใช้ Functions date_diff</h1>
    <?php
    $date1 = date_create("2000-01-01");
    $date2 = date_create("2024-06-15");
    $diff = date_diff($date1,$date2);
    echo "จำนวนวันระหว่างวันที่ 1 มกราคม 2000 ถึง 15 มิถุนายน 2024 คือ "
         . $diff->days . "วัน <br>";
    echo "หรือเท่ากับ" . $diff->y . "ปี , "
                    . $diff->m . "เดือน , "
                    . $diff->d . "วัน <br> ";
        ?>
    
    <h2>ทดสอบการใช้ Math Functions</h2>
    <?php
    $num1 = 10.7;
    $num2 = 15.3;
    $pi   = 3.14159;
    echo "ค่าปัดขึ้นชอง $num1 คือ " . ceil($num1) . "<br>";
    echo "ค่าปัดลงชอง $num2 คือ " . floor($num2) . "<br>";
    echo "ค่าของ pi ปัดเป็นทศนิยม 2 ตำแหน่ง คือ " . round($pi,2) . "<br>";
    echo "ค่าของ pi คือ " . pi() . "<br>";
    echo "ค่ายกกำลัง 3 ของ 5 คือ " . pow(5,3) . "<br>";
    echo "ค่ารากที่สองของ 49 คือ " . sqrt(49) . "<br>";
    echo "ค่าสุ่มระหว่าง 1 ถึง 100 คือ " . rand(1,100) . "<br>";
    echo "ค่าสุ่มระหว่าง 50 ถึง 150 คือ " . rand(50,150) . "<br>";
    echo "ค่าสุ่ม คือ " . rand() . "<br>";
    $arr = array(3,5,1,8,2);
    echo "ค่าสูงสุดในอาเรย์ คือ " . max($arr) . "<br>";
    echo "ค่าต่ำสุดในอาเรย์ คือ " . min($arr) . "<br>";
    ?>
     <h2>ทดสอบการใช้ String Functions</h2>
    <?php
    $str = "Hello PHP Functions";
    echo "ความยาวของสตริง $str คือ " . strlen($str) . " ตัวอักษร<br>";
    echo "สตริง '$str'เมื่อแปลงเป็นตัวพิมพ์ใหญ่ทั้งหมด: " . strtoupper($str) . "<br>";
    echo "สตริง '$str'เมื่อแปลงเป็นตัวพิมพ์เล็กทั้งหมด: " . strtolower($str) . "<br>";
    echo "สตริง '$str'เมื่อแปลงเป็นตัวพิมพ์ใหญ์ตัวแรก: " . ucfirst($str) . "<br>";
    echo "สตริง '$str'เมื่อแปลงเป็นตัวพิมพ์ใหญ์ทุกคำ: " . ucwords($str) . "<br>";
    $substr = "PHP";
    echo "ตำแหน่งของสตริง '$substr' ในสตริง '$str' คือ " . strpos($str,$substr) . "<br>";
    $replaceStr = str_replace("Functions","ฟังก์ชัน",$str);
    echo "เมื่อแทนที่คำว่า 'Functions' ด้วย 'ฟังก์ชัน' ในสตริง '$str' จะได้สตริงใหม่คือ '$replaceStr'<br>";
    $str2 = "PHP           Functions           with           Strings";
    echo "สตริงก่อนลบช่องว่างด้านหน้าและด้านหลัง: '$str2'<br>"; 
    echo "สตริงหลังลบช่องว่างด้านหน้าและด้านหลัง: '" . trim($str2) . "'<br>";
    ?>
    <?php myFooter(); ?> //เรียกใช้ฟังก์ชัน myFooter

</body>
</html>
 <?php 
  function myFooter(){
        echo "<footer><hr>";
        echo "<p>PHP Buit-in Functions Example &copy; 2024</p>";
        echo "<p>จัดทำโดย: Sirisakul </p>";
        echo "</footer>";
    }
    ?>