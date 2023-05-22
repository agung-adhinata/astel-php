<?php
require_once '../config.php';
// session_start();
if (isset($_SESSION['user_id']) and isset($_POST['submitBtn'])) {
  if ($_SESSION['role'] = 1) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $res = $_db->query("UPDATE profil SET nama = '{$name}' WHERE id_pengguna=(SELECT id_pengguna FROM pengguna WHERE id_akun = '{$_SESSION['user_id']}') ");
    $res2 = $_db->query("UPDATE akun SET email ='{$email}', password='{$pass}' WHERE id_akun = '{$_SESSION['user_id']}'");
    echo mysqli_error($_db);
    if ($res and $res2) {
      header('Location: ' . URL . '/app/account');
    }
  }
}