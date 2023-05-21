<?php
require_once '../config.php';

if (isset($_POST['submitBtn'])) {
  // $status = Auth::login($_db->instance, $_POST['email'], $_POST['pass']);
  $result = $_db->query("SELECT id_akun, email FROM akun WHERE email LIKE '{$_POST['email']}' AND password LIKE '{$_POST['pass']}'");
  if (
    $result
  ) {
    $sanitize_arr = $result->fetch_array();
    $id_akun = $sanitize_arr['id_akun'];
    $is_admin = mysqli_num_rows($_db->query("SELECT id_akun FROM admin WHERE id_akun = {$id_akun}")) > 0;

    $_SESSION['user_id'] = $sanitize_arr['email'];
    if ($is_admin) {
      $_SESSION['role'] = 0;
    } else {
      $_SESSION['role'] = 1;
    }
    $status = true;
    if ($status)
      header("Location: " . URL . '/app');
  } else {
    echo 'Error: ' . mysqli_error($_db);
    // header("Location: " . URL . '/login');
  }

}