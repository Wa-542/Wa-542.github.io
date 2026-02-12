<?php
$host = "localhost";
$dbname = "it67040233103";
$user = "it67040233103";
$pass = "R7A8Z1W2";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>
