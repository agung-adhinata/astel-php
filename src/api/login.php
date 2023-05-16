<?php
require_once '../config.php';

if (isset($_POST['submitBtn'])) {
  // $status = Auth::login($_db->instance, $_POST['email'], $_POST['pass']);
  $_SESSION['user_id'] = "id";
  $status = true;
  if ($status == true)
    header("Location: " . URL . '/app');
}