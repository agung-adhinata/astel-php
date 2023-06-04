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

if (!isset($POST['judul']) or !isset($POST['deskripsi']) or !isset($POST['tanggal']) or !isset($POST['idGrup'])) {
  $response = [
    'error' => true,
    'message' => 'missing POST attribute'
  ];
  http_response_code(400);
  echo json_encode($response);
  exit();
} else {

}
$datetime = $_db->query("SELECT ADDTIME(CONVERT(DATE('{$POST['tanggal']}-01'), DATETIME), CURRENT_TIME())");

if (!$datetime) {
  $response = [
    'error' => true,
    'message' => 'date attibute mismatch, ' . $_db->error,
    'stacktrace' => $datetime
  ];
  http_response_code(400);
  echo json_encode($response);
  exit();
}
$datetime = $datetime->fetch_array()[0];
// $response = [
//   'error' => true,
//   'message' => 'pertengahan ' . $datetime
// ];
// http_response_code(400);
// echo json_encode($response);
// exit();

$pengguna_data = $pengguna_data->fetch_array();

$resp1 = $_db->query("INSERT INTO laporan (judul, deskripsi, tanggal,id_grup,id_pengguna ) VALUE ('{$POST['judul']}','{$POST['deskripsi']}','{$datetime}','{$POST['idGrup']}','{$pengguna_data['id_pengguna']}')");

if ($resp1) {
  $response = [
    'error' => false,
  ];
  echo json_encode($response);
  exit();
} else {
  $response = [
    'error' => true,
    'message' => 'error: ' . $_db->error
  ];
  http_response_code(500);
  echo json_encode($response);
  exit();
}