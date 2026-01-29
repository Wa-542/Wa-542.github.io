<?php
require "db_connect_pdo.php";

/* ดึงเฉพาะรายการที่เปิดแสดง */
$stmt = $conn->query("
    SELECT * FROM CatBreeds
    WHERE is_visible = 1
    ORDER BY name_th
");
$cats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>สายพันธุ์แมว</title>

<style>
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:#f3f4f6
}
header{
    background:#111827;
    color:#fff;
    padding:30px;
    text-align:center
}
.container{
    max-width:1200px;
    margin:40px auto;
    padding:0 20px
}
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
    gap:25px
}
.card{
    background:#fff;
    border-radius:18px;
    box-shadow:0 10px 20px rgba(0,0,0,.08);
    overflow:hidden;
    transition:.25s
}
.card:hover{
    transform:translateY(-5px)
}
.card img{
    width:100%;
    height:220px;
    object-fit:cover
}
.card .content{
    padding:20px
}
.card h3{
    margin:0 0 5px;
    font-size:20px
}
.card small{
    color:#6b7280
}
.card p{
    color:#555;
    font-size:14px;
    line-height:1.6;
    height:70px;
    overflow:hidden
}
.btn{
    display:inline-block;
    margin-top:12px;
    background:#2563eb;
    color:#fff;
    padding:8px 16px;
    border-radius:10px;
    text-decoration:none;
    font-size:14px;
    cursor:pointer
}

/* ===== MODAL ===== */
.modal{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.5);
    justify-content:center;
    align-items:center;
    z-index:1000
}
.modal-box{
    background:#fff;
    max-width:700px;
    width:90%;
    padding:25px;
    border-radius:20px;

    max-height:80vh;       /* ⭐ สำคัญ */
    overflow-y:auto;       /* ⭐ เลื่อนได้ */
}
.modal img{
    width:100%;
    max-height:320px;
    object-fit:cover;
    border-radius:15px;
    margin-bottom:15px
}
.close{
    float:right;
    cursor:pointer;
    font-size:22px;
    font-weight:bold
}
.section-title{
    font-weight:bold;
    margin-top:15px
}
body.modal-open{
    overflow:hidden
}
</style>
</head>

<body>

<header>
    <h1>🐱 สายพันธุ์แมว</h1>
    <p>ข้อมูลสายพันธุ์แมวยอดนิยม</p>
</header>

<div class="container">
<div class="grid">

<?php foreach($cats as $c): ?>
<div class="card">
    <img src="<?= $c['image_url'] ?: 'https://via.placeholder.com/400x300?text=No+Image' ?>">

    <div class="content">
        <h3><?= htmlspecialchars($c['name_th']) ?></h3>
        <small><?= htmlspecialchars($c['name_en']) ?></small>
        <p><?= mb_substr(strip_tags($c['description']),0,120) ?>...</p>

        <div class="btn" onclick='openModal(<?= json_encode($c,JSON_UNESCAPED_UNICODE) ?>)'>
            ดูรายละเอียด
        </div>
    </div>
</div>
<?php endforeach; ?>

</div>
</div>

<!-- ===== MODAL DETAIL ===== -->
<div class="modal" id="modal">
<div class="modal-box">
<span class="close" onclick="closeModal()">✖</span>

<img id="m_img" style="display:none">

<h2 id="m_th"></h2>
<h4 id="m_en" style="color:#6b7280"></h4>

<div class="section-title">คำอธิบาย</div>
<p id="m_desc"></p>

<div class="section-title">ลักษณะ</div>
<p id="m_char"></p>

<div class="section-title">การดูแล</div>
<p id="m_care"></p>

</div>
</div>

<script>
const modal = document.getElementById('modal');
const m_img  = document.getElementById('m_img');
const m_th   = document.getElementById('m_th');
const m_en   = document.getElementById('m_en');
const m_desc = document.getElementById('m_desc');
const m_char = document.getElementById('m_char');
const m_care = document.getElementById('m_care');

function openModal(c){
    modal.style.display='flex';
    document.body.classList.add('modal-open');

    m_th.innerText   = c.name_th;
    m_en.innerText   = c.name_en;
    m_desc.innerText = c.description || '-';
    m_char.innerText = c.characteristics || '-';
    m_care.innerText = c.care_instructions || '-';

    if(c.image_url){
        m_img.src = c.image_url;
        m_img.style.display='block';
    }else{
        m_img.style.display='none';
    }
}

function closeModal(){
    modal.style.display='none';
    document.body.classList.remove('modal-open');
}
</script>

</body>
</html>
