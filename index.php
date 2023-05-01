<?php

require_once './config.php';
require_once './partial/Template.php';

$request = $_SERVER['REQUEST_URI'] ?? "";

switch ($request) {
  case '':
  case '/':
    require ROOT_DIR . '/views/home.php';
    break;
  case '/login':
    Template::generateHead("Login", "halaman login");
    echo "halaman login";
    break;
  default:
    echo "404 not found";
    break;
}
