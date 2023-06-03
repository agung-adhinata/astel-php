<?php
require_once '../config.php';
header('Content-type: application/json');



// jika akun belum login
if (!isset($_SESSION['user_id'])) {
  ob_end_clean();
  $response = [
    'error' => true,
    'message' => 'user not authenticated'
  ];
  http_response_code(401);
  echo json_encode($response);
  exit();
}


$pengguna_data = $_db->query("SELECT id_pengguna from pengguna where id_akun = {$_SESSION['user_id']}");

if (!$pengguna_data or mysqli_num_rows($pengguna_data) < 1) {
  $response = [
    'error' => true,
    'message' => 'You\'re not a pengguna, db error: ' . $_db->error
  ];
  http_response_code(400);
  echo json_encode($response);
  exit();
}
$POST = json_decode(file_get_contents('php://input'), true);

if (!isset($POST['name'])) {
  $response = [
    'error' => true,
    'message' => 'You\'re not a pengguna with ' . $POST['name']
  ];
  http_response_code(500);
  echo json_encode($response);
  exit();
}
$pengguna_data = $pengguna_data->fetch_array();

$transaction_data = $_db->query("INSERT INTO grup(nama_grup, id_pengguna) value ('{$POST['name']}', '{$pengguna_data['id_pengguna']}')");

if (!$transaction_data) {
  $response = [
    'error' => true,
    'message' => "Server error: {$_db->error}"
  ];
  http_response_code(500);
  echo json_encode($response);
  exit();
} else {
  $response = [
    "error" => false
  ];
  echo json_encode($response);
  exit;
}