<?php
require_once ROOT_DIR . "/dbconn.php";

class Auth
{

  function __construct()
  {

  }
  static function register(mysqli $db, string $email, string $name, string $password)
  {
    $db->query("INSERT INTO user(email, name, password) values({$email}, {$name}, {$password});");
  }
}