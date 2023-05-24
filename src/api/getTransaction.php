<?php
session_start();
header('Content-type: application/json');

if (isset($_SESSION['user_id'])) {
  $response = [
    'error' => true,
    'message' => 'user not authenticated'
  ];
  http_response_code(401);
  echo json_encode($response);
  exit();
}

$pengguna_data = $_db->query("SELECT id_pengguna from transaction where id_akun = {$_SESSION['user_id']} limit 1");

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

$transaction_data = $_db->query("SELECT * FROM transaksi WHERE id_pengguna = {$pengguna_data['id_pengguna']}");

if (!$transaction_data) {
  $response = [
    'error' => true,
    'message' => "Server error: {$_db->error}"
  ];
  http_response_code(500);
  echo json_encode($response);
  exit();
} else {
  $response = [];
  while ($row = $transaction_data->fetch_assoc()) {
    $response[] = $row;
  }
  echo json_encode($response);
  exit;
}