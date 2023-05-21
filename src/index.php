<?php

require_once 'config.php';

$_base_url = ENV["BASE_URL"] ?? "";
$request = $_SERVER['REQUEST_URI'] ?? "";
# echo $request

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

  case $_base_url . '/app/keuangan':
    require ROOT_DIR . '/views/keuangan.php';
    break;
  case $_base_url . '/app/pengguna':
    require ROOT_DIR . '/views/admin/pengguna.php';
    break;

  case $_base_url . '/app/akun':
    echo "Transaciton Page";
    break;

  default:
    break;
}