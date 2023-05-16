<?php
require_once '../config.php';

if (isset($_POST['submitBtn'])) {
  // $status = Auth::login($_db->instance, $_POST['email'], $_POST['pass']);
  if (
    $result = $_db->instance->query("SELECT email FROM user WHERE email LIKE '{$_POST['email']}' AND password LIKE '{$_POST['pass']}'")
  ) {
    $sanitize_arr = $result->fetch_array();
    $_SESSION['user_id'] = $sanitize_arr['email'];
    $status = true;
    if ($status == true)
      header("Location: " . URL . '/app');
  }

}