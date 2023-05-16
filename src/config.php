<?php

session_start();
function get_base_url()
{
  return sprintf(
    "%s://%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['HTTP_HOST']
  );
}


define("ROOT_DIR", __DIR__);
define("URL", get_base_url());
define("ENV", parse_ini_file('.env'));


require_once ROOT_DIR . '/controller/Template.php';
require_once ROOT_DIR . '/controller/Auth.php';
require_once ROOT_DIR . '/controller/User.php';
require_once ROOT_DIR . '/dbconn.php';

# echo ENV['DB_NAME'];
