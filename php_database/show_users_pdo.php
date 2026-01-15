<?php
require "db_connect_pdo.php";

/* ======================
   CRUD PROCESS
====================== */

// เพิ่มข้อมูล
if (isset($_POST['add'])) {
    $stmt = $conn->prepare(
        "INSERT INTO users (name, sex, phone, email, birthday)
         VALUES (:name, :sex, :phone, :email, :birthday)"
    );
    $stmt->execute([
        ':name' => $_POST['name'],
        ':sex' => $_POST['sex'],
        ':phone' => $_POST['phone'],
        ':email' => $_POST['email'],
        ':birthday' => $_POST['birthday']
    ]);
}

// แก้ไขข้อมูล
if (isset($_POST['update'])) {
    $stmt = $conn->prepare(
        "UPDATE users SET
         name=:name,
         sex=:sex,
         phone=:phone,
         email=:email,
         birthday=:birthday
         WHERE id=:id"
    );
    $stmt->execute([
        ':name' => $_POST['name'],
        ':sex' => $_POST['sex'],
        ':phone' => $_POST['phone'],
        ':email' => $_POST['email'],
        ':birthday' => $_POST['birthday'],
        ':id' => $_POST['id']
    ]);
}

// ลบข้อมูล
if (isset($_POST['delete'])) {
    $stmt = $conn->prepare("DELETE FROM users WHERE id=:id");
    $stmt->execute([':id' => $_POST['id']]);
}

// ดึงข้อมูล
$users = $conn->query("SELECT * FROM users ORDER BY id ASC")
              ->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>ระบบจัดการข้อมูลผู้ใช้งาน (PDO)</title>

<style>
body{font-family:'Segoe UI',sans-serif;background:#f3f4f6}
.container{max-width:1100px;margin:40px auto;background:#fff;padding:30px;border-radius:16px}
h1{text-align:center}
table{width:100%;border-collapse:collapse;margin-top:20px}
th,td{padding:10px;text-align:center}
th{background:#e5e7eb}
tr:nth-child(even){background:#f9fafb}
button{padding:7px 14px;border:none;border-radius:8px;cursor:pointer}
.btn-add{background:#2563eb;color:#fff}
.btn-edit{background:#16a34a;color:#fff}
.btn-del{background:#dc2626;color:#fff}
.btn-cancel{background:#9ca3af;color:#fff}

/* Modal */
.modal{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.45);
    justify-content:center;
    align-items:center;
}
.modal-box{
    background:#fff;
    width:420px;
    padding:25px;
    border-radius:14px;
}
input[type=text],input[type=email],input[type=date]{
    width:100%;
    padding:8px;
    margin-bottom:10px;
    border-radius:8px;
    border:1px solid #d1d5db;
}
.gender-group{text-align:left;margin-bottom:10px}
.gender-group label{margin-right:15px}
</style>
</head>
<body>

<div class="container">
<h1>ระบบจัดการข้อมูลผู้ใช้งาน</h1>

<button class="btn-add" onclick="openAdd()">➕ เพิ่มข้อมูล</button>

<table>
<tr>
<th>ID</th><th>ชื่อ</th><th>เพศ</th>
<th>โทรศัพท์</th><th>Email</th><th>วันเกิด</th><th>จัดการ</th>
</tr>

<?php if (count($users) === 0): ?>
<tr><td colspan="7">ไม่พบข้อมูล</td></tr>
<?php endif; ?>

<?php foreach ($users as $u): ?>
<tr>
<td><?= htmlspecialchars($u['id']) ?></td>
<td><?= htmlspecialchars($u['name']) ?></td>
<td><?= htmlspecialchars($u['sex']) ?></td>
<td><?= htmlspecialchars($u['phone']) ?></td>
<td><?= htmlspecialchars($u['email']) ?></td>
<td><?= htmlspecialchars($u['birthday']) ?></td>
<td>
<button class="btn-edit" onclick='openEdit(<?= json_encode($u) ?>)'>แก้ไข</button>
<button class="btn-del" onclick='openDelete(<?= json_encode($u) ?>)'>ลบ</button>
</td>
</tr>
<?php endforeach; ?>
</table>
</div>

<!-- Modal เพิ่ม / แก้ไข -->
<div class="modal" id="formModal">
<div class="modal-box">
<h3>ข้อมูลผู้ใช้งาน</h3>

<form method="post">
<input type="hidden" name="id" id="user_id">

<label>ชื่อ</label>
<input type="text" name="name" id="user_name" required>

<label>เพศ</label>
<div class="gender-group">
<label><input type="radio" name="sex" value="ชาย"> ชาย</label>
<label><input type="radio" name="sex" value="หญิง"> หญิง</label>
<label><input type="radio" name="sex" value="อื่นๆ"> อื่นๆ</label>
</div>

<label>โทรศัพท์</label>
<input type="text" name="phone" id="user_phone">

<label>Email</label>
<input type="email" name="email" id="user_email">

<label>วันเกิด</label>
<input type="date" name="birthday" id="user_birthday">

<button type="submit" name="add" id="addBtn" class="btn-add">บันทึก</button>
<button type="submit" name="update" id="updateBtn" class="btn-edit">แก้ไข</button>
<button type="button" class="btn-cancel" onclick="closeModal()">ยกเลิก</button>
</form>
</div>
</div>

<!-- Modal ลบ -->
<div class="modal" id="deleteModal">
<div class="modal-box">
<h3>ยืนยันการลบ</h3>
<p id="delText"></p>
<form method="post">
<input type="hidden" name="id" id="delId">
<button type="submit" name="delete" class="btn-del">ลบ</button>
<button type="button" class="btn-cancel" onclick="closeModal()">ยกเลิก</button>
</form>
</div>
</div>

<script>
function openAdd(){
    document.getElementById('formModal').style.display='flex';
    document.getElementById('addBtn').style.display='inline';
    document.getElementById('updateBtn').style.display='none';
    document.querySelector('#formModal form').reset();
}

function openEdit(u){
    document.getElementById('formModal').style.display='flex';
    document.getElementById('addBtn').style.display='none';
    document.getElementById('updateBtn').style.display='inline';

    document.getElementById('user_id').value = u.id;
    document.getElementById('user_name').value = u.name;
    document.getElementById('user_phone').value = u.phone;
    document.getElementById('user_email').value = u.email;
    document.getElementById('user_birthday').value = u.birthday;

    document.querySelectorAll('input[name="sex"]').forEach(r=>{
        r.checked = (r.value === u.sex);
    });
}

function openDelete(u){
    document.getElementById('deleteModal').style.display='flex';
    document.getElementById('delId').value = u.id;
    document.getElementById('delText').innerHTML =
        `ต้องการลบ <b>${u.name}</b><br>${u.email}`;
}

function closeModal(){
    document.getElementById('formModal').style.display='none';
    document.getElementById('deleteModal').style.display='none';
}
</script>

</body>
</html>
