<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>โปรแกรมลงทะเบียนอบรม</title>

    <style>
        body {
            font-family: Tahoma, Arial, sans-serif;
            background-color: #f4f6f8;
        }
        .container {
            width: 800px;
            margin: 30px auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2, h3 {
            text-align: center;
            color: #2c3e50;
        }
        input[type="text"],
        input[type="email"],
        select {
            width: 60%;
            padding: 8px;
        }
        input[type="submit"] {
            padding: 10px 25px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table th {
            background-color: #3498db;
            color: white;
            padding: 10px;
        }
        table td {
            padding: 8px;
            text-align: center;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .success {
            background-color: #eafaf1;
            border-left: 5px solid #2ecc71;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>
<body>

<div class="container">

<h2>โปรแกรมลงทะเบียนอบรม</h2>

<form method="post" action="">
    ชื่อ-นามสกุล :<br>
    <input type="text" name="fullname" required><br><br>

    Email :<br>
    <input type="email" name="email" required><br><br>

    หัวข้ออบรม :<br>
    <select name="course">
        <option value="AI สำหรับงานสำนักงาน">AI สำหรับงานสำนักงาน</option>
        <option value="Excel สำหรับการทำงาน">Excel สำหรับการทำงาน</option>
        <option value="การเขียนเว็บด้วย PHP">การเขียนเว็บด้วย PHP</option>
    </select>
    <br><br>

    อาหารที่ต้องการ : <br>
    <input type="checkbox" name="food[]" value="ปกติ"> ปกติ
    <input type="checkbox" name="food[]" value="มังสวิรัติ"> มังสวิรัติ
    <input type="checkbox" name="food[]" value="ฮาลาล"> ฮาลาล
    <br><br>

    รูปแบบการเข้าร่วม : <br>
    <input type="radio" name="type" value="Onsite" required> Onsite
    <input type="radio" name="type" value="Online"> Online
    <br><br>

    <input type="submit" name="submit" value="ลงทะเบียน">
</form>

<hr>

<?php
/* ===== ประมวลผล ===== */
if (isset($_POST['submit'])) {

    $fullname = $_POST['fullname'];
    $email    = $_POST['email'];
    $course   = $_POST['course'];
    $type     = $_POST['type'];

    // อาหาร
    if (isset($_POST['food'])) {
        $food = implode(",", $_POST['food']);
    } else {
        $food = "ไม่ระบุ";
    }

    // ค่าลงทะเบียน
    if ($type == "Onsite") {
        $price = 1500;
    } else {
        $price = 800;
    }

    // บันทึกไฟล์
    $data = $fullname . "|" . $email . "|" . $course . "|" . $food . "|" . $type . "|" . $price . "\n";
    file_put_contents("register.txt", $data, FILE_APPEND);

    // แสดงผล
    echo "<div class='success'>";
    echo "<h3>ลงทะเบียนสำเร็จ</h3>";
    echo "ชื่อ: $fullname <br>";
    echo "อีเมล: $email <br>";
    echo "หัวข้ออบรม: $course <br>";
    echo "อาหาร: $food <br>";
    echo "รูปแบบ: $type <br>";
    echo "ค่าลงทะเบียน: " . number_format($price, 2) . " บาท<br>";
    echo "</div>";
}
?>

<h3>รายชื่อผู้ลงทะเบียนทั้งหมด</h3>

<?php
if (file_exists("register.txt")) {
    $lines = file("register.txt");

    echo "<table border='1'>";
    echo "<tr>
            <th>ชื่อ</th>
            <th>Email</th>
            <th>หัวข้อ</th>
            <th>อาหาร</th>
            <th>รูปแบบ</th>
            <th>ค่าลงทะเบียน</th>
          </tr>";

    foreach ($lines as $line) {
        list($name, $email, $course, $food, $type, $price) =
            explode("|", trim($line));

        echo "<tr>
                <td>$name</td>
                <td>$email</td>
                <td>$course</td>
                <td>$food</td>
                <td>$type</td>
                <td>" . number_format($price, 2) . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "ยังไม่มีข้อมูลการลงทะเบียน";
}
?>

</div>

</body>
</html>
