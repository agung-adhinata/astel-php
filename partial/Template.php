<?php

class Template
{

  public static function generateHead(String $title, String $description)
  {
    require ROOT_DIR . '/partial/partial_head.php';
  }

  public static function headlessHead(String $title, String $description)
  {
    require ROOT_DIR . '/partial/partial_head_headless.php';
  }
}
