<?php
require_once '../config.php';
unset($_SESSION['user_id']);
unset($_SESSION['role']);
$destroyed = true;
if ($destroyed) {
  header("Location: " . URL . '/login');
}