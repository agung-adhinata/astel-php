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
$admin_data = $_db->query("SELECT id_admin from admin where id_akun = {$_SESSION['user_id']}");

if (!$admin_data or mysqli_num_rows($admin_data) < 1) {
  $response = [
    'error' => true,
    'message' => 'You\'re not a admin'
  ];
  http_response_code(401);
  echo json_encode($response);
  exit();
}

// main app

$POST = json_decode(file_get_contents('php://input'), true);
// input admin json: id, role, email, pass,
// input users json: id, role, email, pass, nama
if (!isset($POST['role']) or !isset($POST['id'])) {
  $response = [
    'error' => true,
    'message' => 'You\'re not define id with '
  ];
  http_response_code(510);
  echo json_encode($response);
  exit();
}
$curr_id = $POST['id'];

$id_akun = "";
// $response = [
//   "error" => true,
//   "message" => "cant remove yourself, sorry " . $curr_id
// ];
// http_response_code(500);
// echo json_encode($response);
// exit();

if (strlen($POST['id']) > 0) {
  // UPDATE admin / pengguna
  if ($POST['role'] == 0) {
    //is admin
    $id_akun = $_db->query("SELECT id_akun FROM admin WHERE id_admin = '{$curr_id}'");
    if (!$id_akun) {
      $response = [
        "error" => true,
        "message" => "cant remove yourself, sorry"
      ];
      http_response_code(500);
      echo json_encode($response);
      exit();
    }
    $id_akun = $id_akun->fetch_array()['id_akun'];

    if (strlen($POST['pass']) > 0) {

      $result_data = $_db->query("UPDATE akun SET email = '{$POST['email']}', password = '{$POST['pass']}' WHERE id_akun = '{$id_akun}'");
      // $response = [
      //   "error" => true,
      //   "message" => "cant remove yourself, sorry " . $_db->error
      // ];
      // http_response_code(500);
      // echo json_encode($response);
      // exit();
    } else {
      $result_data = $_db->query("UPDATE akun SET email = '{$POST['email']}' WHERE id_akun = '{$id_akun}'");
    }
    if ($result_data) {
      $response = [
        "error" => false,
      ];
      echo json_encode($response);
      exit();
    }
  } else {
    //is pengguna
    if (
      $id_akun = $_db->query("SELECT id_akun FROM pengguna WHERE id_pengguna = '{$POST['id']}'")
    ) {
      $id_akun = $id_akun->fetch_array()['id_akun'];
      if (strlen($POST['pass']) > 0)
        $result_data = $_db->query("UPDATE akun SET email = '{$POST['email']}', password = '{$POST['pass']}' WHERE id_akun = '{$id_akun}'");
      else
        $result_data = $_db->query("UPDATE akun SET email = '{$POST['email']}' WHERE id_akun = '{$id_akun}'");
      $result_data = $_db->query("UPDATE profil SET nama = '{$POST['nama']}' WHERE id_pengguna = '{$POST['id']}' ");
      if ($result_data) {
        $response = [
          "error" => false,
        ];
        echo json_encode($response);
        exit();
      } else {
        $response = [
          "error" => true,
          "message" => "server error, " . $_db->error
        ];
        http_response_code(500);
        echo json_encode($response);
        exit();
      }
    }
  }

} else {
  // CREATE admin / pengguna
  $result_data = $_db->query("INSERT INTO akun (email, password) VALUE ('{$POST['email']}','{$POST['pass']}')");
  $result_data = $_db->insert_id;
  if ($POST['role'] == 0) {
    //is admin
    $result_data = $_db->query("INSERT INTO admin (id_akun) VALUE ('{$result_data}')");
    if ($result_data) {
      $response = [
        "error" => false,
      ];
      echo json_encode($response);
      exit();
    }
  } else {
    //is pengguna
    $result1 = $_db->query("INSERT INTO pengguna (id_akun) VALUE ('{$result_data}')");
    $result2 = $_db->query("INSERT INTO profil (id_pengguna, nama) VALUE ('{$_db->insert_id}', '{$POST['nama']}')");
    if ($result1 and $result2) {
      $response = [
        "error" => false
      ];
      echo json_encode($response);
      exit();
    } else {
      $response = [
        "error" => true,
        "message" => "server error, " . $_db->error
      ];
      http_response_code(500);
      echo json_encode($response);
      exit();
    }
  }
}