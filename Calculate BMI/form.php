<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ประมวลผลดัชนีมวลกาย</title>
    <style>
        body { font-family: Tahoma; background:#f2f4f7; }
        .box {
            width: 420px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }
        h2 { text-align:center; }
        label { display:block; margin-top:10px; }
        input, select, button {
            width:100%;
            padding:8px;
            margin-top:5px;
        }
        .btns {
            display:flex;
            gap:10px;
            margin-top:15px;
        }
        button {
            background:#007bff;
            color:white;
            border:none;
            cursor:pointer;
        }
        .clear {
            background:#6c757d;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>ประมวลผลดัชนีมวลกาย</h2>

    <form method="post" action="result.php">
        <label>ชื่อ - สกุล</label>
        <input type="text" name="fullname" required>

        <label>วันเกิด</label>
        <input type="date" name="birthday" required>

        <label>เพศ</label>
        <select name="gender" required>
            <option value="">-- เลือกเพศ --</option>
            <option value="ชาย">ชาย</option>
            <option value="หญิง">หญิง</option>
        </select>

        <label>น้ำหนัก (กิโลกรัม)</label>
        <input type="number" name="weight" step="0.1" required>

        <label>ส่วนสูง (เซนติเมตร)</label>
        <input type="number" name="height" step="0.1" required>

        <div class="btns">
            <button type="submit">Submit</button>
            <button type="reset" class="clear">Clear</button>
        </div>
    </form>
</div>

</body>
</html>
