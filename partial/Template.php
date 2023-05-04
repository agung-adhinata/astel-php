<?php
class Template
{

  /**
   * create head properties with `<head>` tag
   */
  public static function generateHead(string $title, string $description): mixed
  {
    return require ROOT_DIR . '/partial/partial_head.php';
  }
  /**
   * create head properties without `<head>` tag, very usefull
   */
  public static function headlessHeadCooked(string $title, string $description): mixed
  {
    return require ROOT_DIR . '/partial/partial_head_headless.php';
  }
  public static function headlessHeadRaw(): mixed
  {
    return require ROOT_DIR . '/partial/partial_head_headless.php';
  }
}

