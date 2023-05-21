<?php

$_db = mysqli_connect(ENV['DB_HOSTNAME'], ENV['DB_USER'], ENV['DB_PASS'], ENV['DB_NAME']);
if ($_db->connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  exit();
}