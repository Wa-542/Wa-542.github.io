<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include_once "../config/database.php";

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    // ================= GET =================
    case 'GET':
        $result = $conn->query("SELECT * FROM products ORDER BY id DESC");
        $data = [];

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode($data);
        break;

    // ================= POST (เพิ่ม) =================
    case 'POST':
        $data = json_decode(file_get_contents("php://input"));

        $stmt = $conn->prepare("INSERT INTO products (product_name, price) VALUES (?, ?)");
        $stmt->bind_param("sd", $data->product_name, $data->price);

        if ($stmt->execute()) {
            echo json_encode(["message" => "เพิ่มสินค้าเรียบร้อย"]);
        }
        break;

    // ================= PUT (แก้ไข) =================
    case 'PUT':
        $data = json_decode(file_get_contents("php://input"));

        $stmt = $conn->prepare("UPDATE products SET product_name=?, price=? WHERE id=?");
        $stmt->bind_param("sdi", $data->product_name, $data->price, $data->id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "แก้ไขข้อมูลเรียบร้อย"]);
        }
        break;

    // ================= DELETE (ลบ) =================
    case 'DELETE':
        $data = json_decode(file_get_contents("php://input"));

        $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
        $stmt->bind_param("i", $data->id);

        if ($stmt->execute()) {
            echo json_encode(["message" => "ลบข้อมูลเรียบร้อย"]);
        }
        break;
}

$conn->close();
?>
