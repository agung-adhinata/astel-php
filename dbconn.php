<?php
class DbConnect
{
  public $instance;
  function __construct()
  {
    $env = parse_ini_file('.env');
    $this->instance = mysqli_connect($env['DB_HOSTNAME'], $env['DB_USER'], $env['DB_PASS'], $env['DB_NAME']);
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