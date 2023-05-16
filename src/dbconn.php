<?php
class DbConnect
{
  public mysqli $instance;
  function __construct()
  {
    // $this->instance = mysqli_connect(ENV['DB_HOSTNAME'], ENV['DB_USER'], ENV['DB_PASS'], ENV['DB_NAME']);
    $this->instance = mysqli_connect('mysql', 'astel', 'astel', 'astel');
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

$_db = new DbConnect();