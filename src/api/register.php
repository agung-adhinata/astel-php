<?php
require_once '../config.php';

if (isset($_POST['submitBtn'])) {
  // $status = Auth::login($_db->instance, $_POST['email'], $_POST['pass']);
  if (
    $result = $_db->instance->query("INSERT INTO user (email,nama,password) VALUES ('{$_POST['email']}','{$_POST['name']}','{$_POST['pass']}')")
  ) {
    $status = true;
    if ($status == true)
      header("Location: " . URL . '/login');
  }

}