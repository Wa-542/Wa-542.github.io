<?php
require "db_connect_pdo.php";

/* =========================
   UPLOAD SETTING
========================= */
$uploadDir = __DIR__ . "/uploads/";
$uploadUrl = "uploads/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

/* =========================
   ADD
========================= */
if (isset($_POST['add'])) {
    $image = null;
    if (!empty($_FILES['image']['name'])) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $new = "cat_" . time() . "." . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $new);
        $image = $uploadUrl . $new;
    }

    $conn->prepare("
        INSERT INTO CatBreeds
        (name_th,name_en,description,characteristics,care_instructions,image_url,is_visible)
        VALUES (?,?,?,?,?,?,?)
    ")->execute([
        $_POST['name_th'],
        $_POST['name_en'],
        $_POST['description'],
        $_POST['characteristics'],
        $_POST['care_instructions'],
        $image,
        $_POST['is_visible']
    ]);
}

/* =========================
   UPDATE
========================= */
if (isset($_POST['update'])) {
    $sqlImg = "";
    $params = [
        $_POST['name_th'],
        $_POST['name_en'],
        $_POST['description'],
        $_POST['characteristics'],
        $_POST['care_instructions'],
        $_POST['is_visible']
    ];

    if (!empty($_FILES['image']['name'])) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $new = "cat_" . time() . "." . $ext;
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $new);
        $sqlImg = ", image_url=?";
        $params[] = $uploadUrl . $new;
    }

    $params[] = $_POST['id'];

    $conn->prepare("
        UPDATE CatBreeds SET
        name_th=?,name_en=?,description=?,characteristics=?,care_instructions=?,is_visible=?
        $sqlImg
        WHERE id=?
    ")->execute($params);
}

/* =========================
   DELETE
========================= */
if (isset($_POST['delete'])) {
    $conn->prepare("DELETE FROM CatBreeds WHERE id=?")
         ->execute([$_POST['id']]);
}

/* =========================
   FETCH
========================= */
$cats = $conn->query("SELECT * FROM CatBreeds ORDER BY id DESC")
             ->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>Admin CatBreeds</title>
<style>
body{font-family:'Segoe UI',sans-serif;background:#f3f4f6}
.container{max-width:1100px;margin:40px auto;background:#fff;padding:30px;border-radius:18px}
h1{margin-bottom:20px}
table{width:100%;border-collapse:collapse}
th,td{padding:12px;text-align:center}
th{background:#e5e7eb}
tr:nth-child(even){background:#f9fafb}
img{border-radius:12px}
.btn{padding:8px 16px;border-radius:10px;border:none;cursor:pointer;font-weight:500}
.btn-add{background:#2563eb;color:#fff}
.btn-info{background:#0ea5e9;color:#fff}
.btn-edit{background:#16a34a;color:#fff}
.btn-del{background:#dc2626;color:#fff}

/* MODAL */
.modal{display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);justify-content:center;align-items:center;z-index:10}
.box{background:#fff;width:560px;padding:25px;border-radius:18px}
.box h3{margin-top:0}
input,textarea,select{width:100%;padding:10px;border-radius:10px;border:1px solid #d1d5db;margin-bottom:10px}
textarea{resize:vertical}
.modal img{max-width:220px;margin-bottom:10px}
.footer-btns{text-align:right}
</style>
</head>
<body>

<div class="container">
<h1>🐱 ระบบจัดการสายพันธุ์แมว</h1>
<button class="btn btn-add" onclick="openAdd()">➕ เพิ่มข้อมูล</button>

<table>
<tr>
<th>รูป</th>
<th>ชื่อไทย</th>
<th>แสดง</th>
<th>จัดการ</th>
</tr>

<?php foreach($cats as $c): ?>
<tr>
<td>
<?php if($c['image_url']): ?>
<img src="<?= $c['image_url'] ?>" width="70">
<?php else: ?>ไม่มีรูป<?php endif; ?>
</td>
<td><?= htmlspecialchars($c['name_th']) ?></td>
<td><?= $c['is_visible'] ? "✓" : "✗" ?></td>
<td>
<button class="btn btn-info" onclick='openView(<?= json_encode($c) ?>)'>แสดงข้อมูล</button>
</td>
</tr>
<?php endforeach; ?>
</table>
</div>

<!-- ADD / EDIT -->
<div class="modal" id="formModal">
<div class="box">
<h3>ข้อมูลสายพันธุ์แมว</h3>
<form method="post" enctype="multipart/form-data">
<input type="hidden" name="id" id="cid">

<label>รูปภาพ</label>
<input type="file" name="image">

<label>ชื่อไทย</label>
<input name="name_th" id="name_th" required>

<label>ชื่ออังกฤษ</label>
<input name="name_en" id="name_en" required>

<label>คำอธิบาย</label>
<textarea name="description" id="description"></textarea>

<label>ลักษณะ</label>
<textarea name="characteristics" id="characteristics"></textarea>

<label>การดูแล</label>
<textarea name="care_instructions" id="care_instructions"></textarea>

<label>แสดงผล</label>
<select name="is_visible" id="is_visible">
<option value="1">แสดง</option>
<option value="0">ไม่แสดง</option>
</select>

<div class="footer-btns">
<button name="add" id="addBtn" class="btn btn-add">💾 บันทึก</button>
<button name="update" id="updateBtn" class="btn btn-edit">🖊 แก้ไข</button>
<button type="button" class="btn" onclick="closeModal()">ยกเลิก</button>
</div>
</form>
</div>
</div>

<!-- VIEW -->
<div class="modal" id="viewModal">
<div class="box">
<h3 id="v_title"></h3>

<div style="text-align:center">
<img id="v_img" style="display:none">
<p id="no_img" style="color:#888;display:none">ไม่มีรูปภาพ</p>
</div>

<p><b>ชื่ออังกฤษ:</b> <span id="v_en"></span></p>
<p><b>คำอธิบาย:</b> <span id="v_desc"></span></p>
<p><b>ลักษณะ:</b> <span id="v_char"></span></p>
<p><b>การดูแล:</b> <span id="v_care"></span></p>

<form method="post">
<input type="hidden" name="id" id="vid">
<div class="footer-btns">
<button type="button" class="btn btn-edit" onclick="editFromView()">🖊 แก้ไข</button>
<button name="delete" class="btn btn-del">🗑 ลบ</button>
<button type="button" class="btn" onclick="closeModal()">ปิด</button>
</div>
</form>
</div>
</div>

<script>
let current;

function openAdd(){
 formModal.style.display='flex';
 addBtn.style.display='inline';
 updateBtn.style.display='none';
 document.querySelector('#formModal form').reset();
}

function openView(c){
 current=c;
 viewModal.style.display='flex';

 v_title.innerText=c.name_th;
 v_en.innerText=c.name_en;
 v_desc.innerText=c.description;
 v_char.innerText=c.characteristics;
 v_care.innerText=c.care_instructions;
 vid.value=c.id;

 if(c.image_url){
    v_img.src=c.image_url;
    v_img.style.display='block';
    no_img.style.display='none';
 }else{
    v_img.style.display='none';
    no_img.style.display='block';
 }
}

function editFromView(){
 closeModal();
 openAdd();
 addBtn.style.display='none';
 updateBtn.style.display='inline';

 cid.value=current.id;
 name_th.value=current.name_th;
 name_en.value=current.name_en;
 description.value=current.description;
 characteristics.value=current.characteristics;
 care_instructions.value=current.care_instructions;
 is_visible.value=current.is_visible;
}

function closeModal(){
 document.querySelectorAll('.modal').forEach(m=>m.style.display='none');
}
</script>

</body>
</html>
