<?php
class Template
{
  /**
   * create head properties with `<head>` tag
   */
  public static function getHead(string $title, string $desc)
  {
    require ROOT_DIR . '/partial/partial_head.php';
  }
  /**
   * create head properties without `<head>` tag, very usefull
   */
  public static function getHeadlessHead(string $title, string $desc)
  {
    require ROOT_DIR . '/partial/partial_head_headless.php';
  }
}