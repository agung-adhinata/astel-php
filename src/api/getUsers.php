<?php
require_once '../config.php';
$run = true;
header('Content-type: application/json');

// cek apakah akun sudah login
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

if ($run) {
  $lists = $_db->query("SELECT * FROM akun");
  if ($lists == false) {
    $responseJson = [
      "error" => "true",
      "message" => "Query Failed"
    ];
    http_response_code(500);
    echo json_encode($responseJson);
    exit();
  } else {
    $response = array();
    while ($row = $lists->fetch_assoc()) {
      $response[] = $row;
    }
    echo json_encode($response);
    exit();
  }
}