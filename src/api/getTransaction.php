<?php
session_start();
if (isset($_SESSION['user_id'])) {
  $response = array('error' => true);
  echo json_encode($response);
}
die;