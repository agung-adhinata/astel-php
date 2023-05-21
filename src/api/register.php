<?php
require_once '../config.php';

if (isset($_POST['submitBtn'])) {
  // $status = Auth::login($_db->instance, $_POST['email'], $_POST['pass']);
  $status = false;
  $is_email_exist = $_db->query("SELECT email, password FROM akun WHERE email LIKE '{$_POST['email']}'");
  if (mysqli_num_rows($is_email_exist) > 0) {
    // echo 'Error: ' . mysqli_error($_db);
    // echo 'value: ' . mysqli_num_rows($is_email_exist);
    header("Location: " . URL . '/register');
    return;
  }

  $result = $_db->query("INSERT INTO akun (email, password) VALUES ('{$_POST['email']}','{$_POST['pass']}')");
  if ($result) {
    if ($result = $_db->query("INSERT INTO pengguna (id_akun) VALUES ('{$_db->insert_id}')")) {
      $profil_status = $_db->query("INSERT INTO profil (id_pengguna, nama) values ('{$_db->insert_id}','{$_POST['name']}')");
      if ($profil_status) {
        $status = true;
      }
    }

    if ($profil_status)
      $status = true;
    if ($status == true)
      header("Location: " . URL . '/login');
  }
} else {
  header("Location: " . URL . '/register');
}