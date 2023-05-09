<?php

require_once './config.php';
require_once './partial/Template.php';
require_once './dbconn.php';

$db = new DbConnect();
$_base_url = ENV["BASE_URL"] ?? '';
$request = $_SERVER['REQUEST_URI'] ?? "";

switch ($request) {
  case $_base_url . '':
  case $_base_url . '/':
    require ROOT_DIR . '/views/home.php';
    break;
  case $_base_url . '/dev':
    require ROOT_DIR . '/views/devui.php';
    break;

  case $_base_url . '/login':
    Template::getHead("Login", "halaman login");
    echo "halaman login";
    break;

  default:
    echo "404 not found\n";
    echo $request;
    break;
}