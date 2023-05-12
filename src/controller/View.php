<?php
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
  static function login()
  {
    require View::getView('login.php');
  }
  static function register()
  {
    require View::getView('register.php');
  }
}