<?php

require_once './config.php';
require_once './controller/Template.php';
require_once './dbconn.php';

$db = new DbConnect();
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
    echo "Register Page";
    break;
  case $_base_url . '/dash':
    echo "Register Page";
    break;

  case $_base_url . '/dash/lists':
    echo "Register Page";
    break;

  default:
    echo "404 not found\n";
    echo $request;
    break;
}