<?php
class Template
{

  /**
   * create head properties with `<head>` tag
   */
  public static function getHead(string $title, string $desc): mixed
  {
    return require ROOT_DIR . '/partial/partial_head.php';
  }
  /**
   * create head properties without `<head>` tag, very usefull
   */
  public static function getHeadlessHead(string $title, string $desc): mixed
  {
    return require ROOT_DIR . '/partial/partial_head_headless.php';
  }
  /**
   *create head props with title and description depends on global variable `$title` and `$description`. That variable
   * should be created before calling this method.
   */
  private static function headlessHeadRaw(): mixed
  {
    return require ROOT_DIR . '/partial/partial_head_headless.php';
  }
}