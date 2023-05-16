<?php
require_once '../config.php';
unset($_SESSION['user_id']);
$destroyed = true;
if ($destroyed) {
  header("Location: " . URL . '/login');
}