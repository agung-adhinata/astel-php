<?php
require_once ROOT_DIR . "/dbconn.php";

class Auth
{
  static function register(mysqli $db, string $email, string $name, string $password)
  {
    $db->query("INSERT INTO user(email, name, password) values({$email}, {$name}, {$password})");
  }
  static function login(mysqli $db, string $email, string $password)
  {
    if (
      $result = $db->query("SELECT email,password,id FROM user")
    ) {
      $res = mysqli_fetch_array($result);
      if ($res['password'] == $password) {
        $_SESSION['email'] = $res['id'];
        return true;
      }
      return false;
    }

  }
}