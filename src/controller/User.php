<?php

class Account
{
  function createAccount(mysqli $db, string $email, string $password, string $nama, string $role)
  {
    if (
      $result = $db->query("SELECT email FROM user WHERE email LIKE '{$email}'")
    ) {
      $result->fetch_array();
      if ($result['email'] == $email) {

      }
    }
  }
  function changeName(mysqli $db, string $user_id, string $new_name)
  {
    if ($result = $db->query("UPDATE user SET nama = {$new_name} WHERE id LIKE {$user_id}")) {
      return true;
    }
    return false;
  }
  function changePassword(mysqli $db, string $user_id, string $old_password, string $new_password)
  {
    if ($result = $db->query("SELECT password FROM user WHERE id LIKE {$user_id}")) {
      $result->fetch_array();
      if ($result['password'] != $old_password)
        return false;

      if ($db->query("UPDATE user SET password = {$new_password} WHERE id LIKE {$user_id}"))
        return true;
    }
    return false;
  }
  function deleteAccount(mysqli $db, string $user_id)
  {

  }
}