<?php
include 'php_connect.php';

/* ================= เพิ่ม / แก้ไข ================= */
if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $sex = $_POST['sex'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];

    if ($id == "") {
        mysqli_query($conn,
            "INSERT INTO users (name,sex,phone,email,birthday)
             VALUES ('$name','$sex','$phone','$email','$birthday')"
        );
    } else {
        mysqli_query($conn,
            "UPDATE users SET
                name='$name',
                sex='$sex',
                phone='$phone',
                email='$email',
                birthday='$birthday'
             WHERE id=$id"
        );
    }
    header("Location: crud_users.php");
    exit;
}

/* ================= ลบ ================= */
if (isset($_POST['confirm_delete'])) {
    $id = $_POST['delete_id'];
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");
    header("Location: crud_users.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>CRUD Users</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
<div class="container mt-4">

<!-- ================= ฟอร์มเพิ่มข้อมูล ================= -->
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-primary text-white">➕ เพิ่มข้อมูลผู้ใช้</div>
    <div class="card-body">
        <form method="post">
            <input type="hidden" name="id">

            <div class="mb-2">
                <label>ชื่อ</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <!-- เพศ (Radio) -->
            <div class="mb-2">
                <label class="form-label">เพศ</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sex" id="sex_male" value="ชาย" required>
                    <label class="form-check-label" for="sex_male">ชาย</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="sex" id="sex_female" value="หญิง">
                    <label class="form-check-label" for="sex_female">หญิง</label>
                </div>
            </div>

            <div class="mb-2">
                <label>โทรศัพท์</label>
                <input type="text" name="phone" class="form-control">
            </div>

            <div class="mb-2">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label>วันเกิด</label>
                <input type="date" name="birthday" class="form-control">
            </div>

            <button type="submit" name="save" class="btn btn-primary w-100">
                เพิ่มข้อมูล
            </button>
        </form>
    </div>
</div>

<!-- ================= ตารางข้อมูล ================= -->
<h4>📋 รายชื่อผู้ใช้</h4>
<table class="table table-dark table-striped">
<thead>
<tr>
    <th>ID</th>
    <th>ชื่อ</th>
    <th>เพศ</th>
    <th>โทรศัพท์</th>
    <th>Email</th>
    <th>วันเกิด</th>
    <th>จัดการ</th>
</tr>
</thead>
<tbody>

<?php
$result = mysqli_query($conn, "SELECT * FROM users");
while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['sex'] ?></td>
    <td><?= $row['phone'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['birthday'] ?></td>
    <td>
        <button class="btn btn-warning btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#editModal<?= $row['id'] ?>">
            แก้ไข
        </button>

        <button class="btn btn-danger btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#deleteModal<?= $row['id'] ?>">
            ลบ
        </button>
    </td>
</tr>

<!-- ================= Modal แก้ไข ================= -->
<div class="modal fade" id="editModal<?= $row['id'] ?>">
<div class="modal-dialog">
<div class="modal-content">
<form method="post">

<div class="modal-header bg-warning">
    <h5 class="modal-title">✏️ แก้ไขข้อมูล</h5>
</div>

<div class="modal-body">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">

    <p><b>ID:</b> <?= $row['id'] ?></p>

    <div class="mb-2">
        <label>ชื่อ</label>
        <input type="text" name="name" class="form-control" value="<?= $row['name'] ?>" required>
    </div>

    <!-- เพศ (Radio) -->
    <div class="mb-2">
        <label class="form-label">เพศ</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio"
                   name="sex"
                   id="edit_male<?= $row['id'] ?>"
                   value="ชาย"
                   <?= $row['sex']=="ชาย" ? "checked" : "" ?>>
            <label class="form-check-label" for="edit_male<?= $row['id'] ?>">ชาย</label>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio"
                   name="sex"
                   id="edit_female<?= $row['id'] ?>"
                   value="หญิง"
                   <?= $row['sex']=="หญิง" ? "checked" : "" ?>>
            <label class="form-check-label" for="edit_female<?= $row['id'] ?>">หญิง</label>
        </div>
    </div>

    <div class="mb-2">
        <label>โทรศัพท์</label>
        <input type="text" name="phone" class="form-control" value="<?= $row['phone'] ?>">
    </div>

    <div class="mb-2">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?= $row['email'] ?>">
    </div>

    <div class="mb-2">
        <label>วันเกิด</label>
        <input type="date" name="birthday" class="form-control" value="<?= $row['birthday'] ?>">
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
    <button type="submit" name="save" class="btn btn-success">ยืนยัน</button>
</div>

</form>
</div>
</div>
</div>

<!-- ================= Modal ลบ ================= -->
<div class="modal fade" id="deleteModal<?= $row['id'] ?>">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
<form method="post">

<div class="modal-header bg-danger text-white">
    <h5 class="modal-title">🗑️ ยืนยันการลบ</h5>
</div>

<div class="modal-body">
    <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
    <p><b>ID:</b> <?= $row['id'] ?></p>
    <p><b>ชื่อ:</b> <?= $row['name'] ?></p>
    <p><b>เพศ:</b> <?= $row['sex'] ?></p>
    <p><b>โทรศัพท์:</b> <?= $row['phone'] ?></p>
    <p><b>Email:</b> <?= $row['email'] ?></p>
    <p><b>วันเกิด:</b> <?= $row['birthday'] ?></p>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
    <button type="submit" name="confirm_delete" class="btn btn-danger">ยืนยัน</button>
</div>

</form>
</div>
</div>
</div>

<?php } ?>

</tbody>
</table>

</div>
</body>
</html>
