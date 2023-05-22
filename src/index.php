<?php

require_once 'config.php';

$_base_url = ENV["BASE_URL"] ?? "";
$request = $_SERVER['REQUEST_URI'] ?? "";
// echo $request;

# router app
switch ($request) {
  case $_base_url . '':
  case $_base_url . '/':
    require ROOT_DIR . '/views/home.php';
    break;
  case $_base_url . '/dev':
    require ROOT_DIR . '/views/devui.php';
    break;

  case $_base_url . '/login':
    require ROOT_DIR . '/views/login.php';
    break;

  case $_base_url . '/register':
    require ROOT_DIR . '/views/register.php';
    break;

  case $_base_url . '/app':
    require ROOT_DIR . '/views/dashboard.php';
    break;

  // Pengguna
  case $_base_url . '/app/keuangan':
    require ROOT_DIR . '/views/pengguna/keuangan.php';
    break;


  case $_base_url . '/app/report':
    require ROOT_DIR . '/views/pengguna/report.php';
    break;

  case $_base_url . '/app/account':
    if ($_SESSION['role'] == 0) {
      require ROOT_DIR . '/views/admin/dash_profile.php';
    } else {
      require ROOT_DIR . '/views/dash_profile.php';
    }
    break;

  // Admin
  case $_base_url . '/app/pengguna':
    require ROOT_DIR . '/views/admin/pengguna.php';
    break;

  case $_base_url . '/app/admins':
    require ROOT_DIR . '/views/admin/admin.php';
    break;

  default:
    break;
}