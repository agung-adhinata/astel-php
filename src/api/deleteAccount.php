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

// harus akun admin
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

if (isset($_GET['id']) and isset($_GET['role'])) {
  if ($_GET['role'] == 0) {
    if ($result = $_db->query("SELECT id_akun as id FROM admin where id_admin = '{$_GET['id']}'")) {
      $id_akun = $result->fetch_array()['id'];
      $result = $_db->query("DELETE FROM admin WHERE id_admin = '{$_GET['id']}'");
      if ($result) {
        $result = $_db->query("DELETE FROM akun WHERE id_akun = '{$id_akun}'");
        if ($result) {
          $response = [
            "error" => false
          ];
          echo json_encode($response);
          exit();
        }
      }
    }
  } else if ($_GET['role'] == 1) {
    if ($result = $_db->query("SELECT id_akun as id FROM pengguna where id_pengguna = '{$_GET['id']}'")) {
      $id_akun = $result->fetch_array()['id'];
      $res = $_db->query("DELETE FROM akun WHERE id_akun = {$id_akun}");
      if ($res) {
        $response = [
          "error" => false,
          "message" => "gold"
        ];
        echo json_encode($response);
        exit();
      } else {
        $response = [
          "error" => true,
          "message" => "error when deleting file, " . $_db->error
        ];
        http_response_code(500);
        echo json_encode($response);
        exit();
      }
    }
    $response = [
      "error" => true,
      "message" => "gold " . $_db->error
    ];
    http_response_code(500);
    echo json_encode($response);
    exit();
  }
}
$response = [
  "error" => true
];
http_response_code(500);
echo json_encode($response);
exit();
