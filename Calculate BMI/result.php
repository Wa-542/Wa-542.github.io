<?php
// ===== Function คำนวณ BMI =====
function calculateBMI($weight, $height_cm) {
    $height_m = $height_cm / 100;
    return $weight / ($height_m * $height_m);
}

// ===== Function คำนวณอายุ =====
function calculateAge($birthday) {
    $birth = new DateTime($birthday);
    $today = new DateTime();
    return $today->diff($birth);
}

// รับค่าจากฟอร์ม
$name = $_POST['fullname'];
$birthday = $_POST['birthday'];
$gender = $_POST['gender'];
$weight = $_POST['weight'];
$height = $_POST['height'];

$bmi = calculateBMI($weight, $height);
$age = calculateAge($birthday);

// แปลผล BMI (อ้างอิงแบบโรงพยาบาล)
if ($bmi < 18.5) {
    $bmi_text = "ผอม";
    $advice = "ควรรับประทานอาหารให้ครบ 5 หมู่ และเพิ่มน้ำหนักอย่างเหมาะสม";
} elseif ($bmi < 23) {
    $bmi_text = "ปกติ";
    $advice = "สุขภาพดี ควรรักษาระดับนี้ไว้";
} elseif ($bmi < 25) {
    $bmi_text = "ท้วม";
    $advice = "ควรควบคุมอาหารและออกกำลังกายสม่ำเสมอ";
} elseif ($bmi < 30) {
    $bmi_text = "อ้วนระดับ 1";
    $advice = "มีความเสี่ยงต่อโรค ควรควบคุมอาหารและออกกำลังกาย";
} else {
    $bmi_text = "อ้วนระดับ 2";
    $advice = "เสี่ยงต่อโรคเรื้อรัง ควรปรึกษาแพทย์";
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ผลการประมวลผล BMI</title>
    <style>
        body { font-family: Tahoma; background:#eef1f5; }
        .box {
            width: 480px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        h2 { text-align:center; }
        p { font-size:16px; }
        .highlight { font-size:20px; color:#007bff; }
        a {
            display:block;
            text-align:center;
            margin-top:20px;
            text-decoration:none;
            background:#28a745;
            color:white;
            padding:10px;
            border-radius:5px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>ผลการประมวลผล</h2>

    <p>ชื่อ - สกุล : <?= $name ?></p>
    <p>เพศ : <?= $gender ?></p>
    <p>วันเกิด : <?= $birthday ?></p>
    <p>อายุ : <?= $age->y ?> ปี <?= $age->m ?> เดือน <?= $age->d ?> วัน</p>
    <p>น้ำหนัก : <?= $weight ?> กก.</p>
    <p>ส่วนสูง : <?= $height ?> ซม.</p>

    <p class="highlight">ค่า BMI : <?= number_format($bmi, 2) ?></p>
    <p>แปลผลค่า BMI : <?= $bmi_text ?></p>
    <p>คำแนะนำค่า BMI : <?= $advice ?></p>

    <a href="form.php">ย้อนกลับ</a>
</div>

</body>
</html>
