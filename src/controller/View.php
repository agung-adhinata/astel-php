<?php
require_once ROOT_DIR . '/dbconn.php';
class View
{
  static private function getView(string $s)
  {
    return ROOT_DIR . '/views/' . $s;
  }
  static function index()
  {
    require View::getView('home.php');
  }
  static function login(DbConnect $_db)
  {
    $message = '';
    if (isset($_POST['submitBtn'])) {
      // $status = Auth::login($_db->instance, $_POST['email'], $_POST['pass']);
      $status = true;
      if ($status == true)
        header("Location: " . URL . '/dev');
    }
    require View::getView('login.php');
  }
  static function register(DbConnect $_db)
  {
    if (isset($_POST['submitBtn'])) {
      // $status = Auth::register($_db->instance, $_POST['email'], $_POST['name'], $_POST['pass']);
      $status = true;
      if ($status == true)
        header("Location: " . URL . '/dev');
    }
    require View::getView('register.php');
  }
}