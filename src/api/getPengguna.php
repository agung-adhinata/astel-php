<?php
require_once '../config.php';
$run = true;
header('Content-type: application/json');
// Menampilkan json daftar pengguna ketika memilih menu pengguna oleh admin
// cek apakah akun sudah login and role harus admin
if (!isset($_SESSION['user_id'])) {
  $responseJson = [
    "error" => "true",
    "message" => "User Not Authenticated"
  ];
  http_response_code(410);
  echo json_encode($responseJson);
  exit();
}

$is_admin = $_db->query("SELECT id_akun FROM admin WHERE id_akun = {$_SESSION['user_id']}");

if (!$is_admin or mysqli_num_rows($is_admin) < 1) {
  $responseJson = [
    "error" => "true",
    "message" => "User Is Not Admin"
  ];
  http_response_code(403);
  echo json_encode($responseJson);
  exit();
}

$response_data = $_db->query("SELECT pengguna.id_pengguna as id_pengguna, akun.email as email, profil.nama as nama FROM akun INNER JOIN pengguna ON akun.id_akun = pengguna.id_akun INNER JOIN profil ON pengguna.id_pengguna = profil.id_pengguna");

if (!$response_data) {
  $response = [
    'error' => true,
    'message' => "Server error: {$_db->error}"
  ];
  http_response_code(500);
  echo json_encode($response);
  exit();
} else {
  $response = [];
  while ($row = $response_data->fetch_assoc()) {
    $response[] = $row;
  }
  echo json_encode($response);
  exit;
}