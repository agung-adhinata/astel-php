<?php
require_once '../config.php';
header('Content-type: application/json');
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
$pengguna_data = $_db->query("SELECT id_pengguna from pengguna where id_akun = {$_SESSION['user_id']}");

if (!$pengguna_data or mysqli_num_rows($pengguna_data) < 1) {
  $response = [
    'error' => true,
    'message' => 'You\'re not a pengguna'
  ];
  http_response_code(401);
  echo json_encode($response);
  exit();
}
$pengguna_data = $pengguna_data->fetch_array();

$group_data = $_db->query("SELECT * FROM laporan WHERE id_pengguna = {$pengguna_data['id_pengguna']} ORDER BY tanggal DESC");

if (!$group_data) {
  $response = [
    'error' => true,
    'message' => "Server error: {$_db->error}"
  ];
  http_response_code(500);
  echo json_encode($response);
  exit();
} else {
  $response = [];
  while ($row = $group_data->fetch_assoc()) {
    $response[] = $row;
  }
  echo json_encode($response);
  exit;
}