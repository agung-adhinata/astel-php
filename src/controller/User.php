<?php

class User
{
  function createUser(mysqli $db, string $email, string $password, string $nama)
  {
    if (
      $result = $db->query("SELECT email FROM user WHERE email LIKE '{$email}'")
    ) {
      $result->fetch_array();
      if ($result['email'] == $email) {

      }
    }
  }
}