<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ข้อมูลนักศึกษา</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f4f7fb;
            font-family: 'Prompt', sans-serif;
        }
        .container {
            max-width: 750px;
            margin: 40px auto;
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0px 5px 20px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }
        .box {
            background: #ecf5ff;
            border-left: 5px solid #3498db;
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: 10px;
        }
        .pattern {
            background: #fafafa;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #ddd;
            margin-top: 25px;
            font-family: monospace;
            font-size: 18px;
            line-height: 28px;
        }
        .loop-title {
            font-weight: bold;
            color: #1e4f79;
            margin-top: 20px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>ข้อมูลนักศึกษา</h2>

    <?php
        $university = "มหาวิทยาลัยราชภัฏอุดรธานี";
        $faculty = "คณะวิทยาศาสตร์";
        $major = "สาขาเทคโนโลยีสารสนเทศ";

        $name = "นางสาว สิริสกุล คงคะรัศมี";
        $info = "หนูเป็นนักศึกษาชั้นปีที่ 2 สนใจด้านเว็บไซต์และชอบการออกแบบหน้าเว็บ";
    ?>

    <div class="box">
        <p><b>มหาวิทยาลัย:</b> <?= $university; ?></p>
        <p><b>คณะ:</b> <?= $faculty; ?></p>
        <p><b>สาขา:</b> <?= $major; ?></p>
        <hr>
        <p><b>ชื่อ - นามสกุล:</b> <?= $name; ?></p>
        <p><b>แนะนำตัว:</b> <?= $info; ?></p>
    </div>

    <h3>รูปแบบที่สร้างด้วย Loop</h3>

    <div class="pattern">

        <!-- รูปแบบ 1 -->
        <div class="loop-title">ใช้: for loop</div>
        <?php
        for($i = 1; $i <= 4; $i++){
            for($j = 1; $j <= $i; $j++){
                echo "*";
            }
            echo "<br>";
        }
        ?>

        <br>

        <!-- รูปแบบ 2 -->
        <div class="loop-title">ใช้: for loop</div>
        <?php
        for($n = 1; $n <= 3; $n++){
            for($i = 1; $i <= 4; $i++){
                echo $n . " ";
            }
            echo "<br>";
        }
        ?>

        <br>

        <!-- รูปแบบ 3 -->
        <div class="loop-title">ใช้: for loop</div>
        <?php
        for($i = 1; $i <= 3; $i++){
            for($j = 1; $j <= $i; $j++){
                echo $i . " ";
            }
            echo "<br>";
        }
        ?>

        <br>

        <!-- รูปแบบ 4 -->
        <div class="loop-title">ใช้: do...while loop</div>
        <?php
        echo "* * * * *<br>";

        $i = 1;
        do {
            echo "* ";
            for($j = 1; $j <= 4; $j++){
                echo $i . " ";
            }
            echo "*<br>";
            $i++;
        } while($i <= 3);

        echo "* * * * *<br>";
        ?>

        <br>

        <!-- รูปสุดท้าย -->
        <div class="loop-title">ใช้: while loop</div>
        <?php
        $i = 3;
        while($i >= 1){
            for($j = 1; $j <= $i; $j++){
                echo $i . " ";
            }
            echo "<br>";
            $i--;
        }
        ?>

    </div>
</div>

</body>
</html>
