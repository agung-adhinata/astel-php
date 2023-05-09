<?php
require_once './config.php';
class DbConnect
{
  public $instance;
  function __construct()
  {
    $this->instance = mysqli_connect(ENV['DB_HOSTNAME'], ENV['DB_USER'], ENV['DB_PASS'], ENV['DB_NAME']);
  }
  function query(string $query)
  {
    $hasil = mysqli_query($this->instance, $query);
    if ($hasil) {
      return $hasil;
    }
    return null;
  }
}