<?php
require_once '../config.php';
header('Content-type: application/json');
// Menampilkan json daftar admin ketika memilih menu admin oleh admin
// jika akun belum login
if (!isset($_SESSION['user_id'])) {
  $response = [
    'error' => true,
    'message' => 'user not authenticated'
  ];
  http_response_code(401);
  echo json_encode($response);
  exit();
}

// harus akun pengguna
$admin_data = $_db->query("SELECT id_admin from admin where id_akun = {$_SESSION['user_id']}");

if (!$admin_data or mysqli_num_rows($admin_data) < 1) {
  $response = [
    'error' => true,
    'message' => 'You\'re not a pengguna'
  ];
  http_response_code(401);
  echo json_encode($response);
  exit();
}
$admin_data = $admin_data->fetch_array();

$response_data = $_db->query("SELECT admin.id_admin as id_admin, akun.email as email FROM admin INNER JOIN akun ON admin.id_akun = akun.id_akun");

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