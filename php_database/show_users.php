<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อผู้ใช้งาน</title>

    <style>
        body {
            font-family: "Segoe UI", Tahoma, sans-serif;
            background: linear-gradient(135deg, #fdfbfb, #ebedee);
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        h1 {
            text-align: center;
            color: #6b7280;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 12px;
        }

        table th {
            background-color: #c7d2fe; /* pastel indigo */
            color: #374151;
            padding: 14px;
            font-weight: 600;
            text-align: center;
        }

        table td {
            padding: 12px;
            text-align: center;
            color: #374151;
        }

        table tr {
            background-color: #f9fafb;
        }

        table tr:nth-child(even) {
            background-color: #eef2ff; /* pastel blue */
        }

        table tr:hover {
            background-color: #e0e7ff;
            transition: 0.2s;
        }

        .no-data {
            text-align: center;
            background-color: #fef2f2;
            color: #b91c1c;
            padding: 15px;
            border-radius: 10px;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="container">

<h1>รายชื่อผู้ใช้งาน</h1>

<?php
    include 'php_connect.php';

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>รหัส</th>
                    <th>ชื่อ-สกุล</th>
                    <th>เพศ</th>
                    <th>โทรศัพท์</th>
                    <th>อีเมล</th>
                    <th>วันเกิด</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['sex']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['birthday']}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<div class='no-data'>ไม่พบข้อมูลผู้ใช้งาน</div>";
    }

    $conn->close();
?>

</div>

</body>
</html>
