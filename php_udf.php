<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การใช้ ฟังก์ชันที่ผู้ใช้กำหนดเอง (User-Defined Functions)</title>
</head>
<body>
    <h1>การใช้ ฟังก์ชันที่ผู้ใช้กำหนดเอง (User-Defined Functions)</h1>

    <?php
    // เรียกฟังก์ชัน sum()
    echo "ผลบวกของ 10 กับ 20 คือ: " . sum(10, 20) . "<br>";
    echo "ผลบวกของ 15 กับ 25 คือ: " . sum(15, 25) . "<br>";

    $a = 30; 
    $b = 45;
    echo "ผลบวกของ $a กับ $b คือ: " . sum($a, $b) . "<br>";

    // เรียกฟังก์ชัน add_five()
    $num = 50;
    $new_value = add_five($num);
    echo "ค่าของ num ก่อนเรียกใช้ฟังก์ชัน add_five() คือ: $num <br>";
    echo "ค่าของ num หลังเรียกใช้ฟังก์ชัน add_five() คือ: $new_value <br>";
    ?>

    <h2>ตัวอย่างฟังก์ชันที่มีพารามิเตอร์หลายตัว (...$x)</h2>

    <?php
    // เรียกใช้ฟังก์ชัน sumListNumbers()
    echo "ผลบวกของตัวเลข 5, 10, 15 คือ: " . sumListNumbers(5, 10, 15) . "<br>";

    echo "ผลบวกของตัวเลข 1-10 คือ: " 
        . sumListNumbers(1,2,3,4,5,6,7,8,9,10) . "<br>";
    ?>

<h2>ตัวอย่างฟังก์ ที่มีพารามิเตอร์ค่าเริ่มต้น</h2>
<?php
    function thai_date($strDate = "nom"){
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));

        $thaiMonthArr = array(
            "",
            "มกราคม",
            "กุมภาพันธ์",
            "มีนาคม",
            "เมษายน",
            "พฤษภาคม",
            "มิถุนายน",
            "กรกฎาคม",
            "สิงหาคม",
            "กันยายน",
            "ตุลาคม",
            "พฤศจิกายน",
            "ธันวาคม"
        );
        $strMonthThai = $thaiMonthArr[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }
    echo thai_date("2024-12-11") . "<br>";
    echo thai_date(); //ใช้ค่าเริ่มต้มเป็นวันที่ปัจจุบัน
    ?>


</body>
</html>

<?php
// ส่วนฟังก์ชัน (User-Defined Functions)

// ฟังก์ชันบวกเลข 2 ตัว
function sum($num1, $num2) {
    return $num1 + $num2;
}

// ฟังก์ชันเพิ่มค่า +5 และส่งค่ากลับ
function add_five($num) {
    $value = $num + 5;
    echo "ค่าภายในฟังก์ชัน add_five() คือ: $value <br>";
    return $value;
}

// ฟังก์ชันบวกเลขหลายตัว (...$x)
function sumListNumbers(...$x) {
    $total = 0;
    foreach ($x as $value) {
        $total += $value;
    }
    return $total;
}
?>
