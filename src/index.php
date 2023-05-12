<?php

require_once './config.php';
require_once './controller/Template.php';
require_once './controller/Auth.php';
require_once './controller/User.php';
require_once './controller/View.php';
require_once './dbconn.php';



$_base_url = ENV["BASE_URL"] ?? "";
$request = $_SERVER['REQUEST_URI'] ?? "";
# echo $request

# router app
switch ($request) {
  case $_base_url . '':
  case $_base_url . '/':
    View::index();
    break;
  case $_base_url . '/dev':
    require ROOT_DIR . '/views/devui.php';
    break;

  case $_base_url . '/login':
    View::login();
    break;

  case $_base_url . '/register':
    View::register();
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