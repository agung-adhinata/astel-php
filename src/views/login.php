<?php
$message = "";
if (isset($_POST['submitBtn'])) {
  $input = $_POST['email'];
  $message = 'Your email is' . $input;
}
?>
<html>

<head>
  <?php
  Template::getHeadlessHead("Login - Astel", "Login form");
  ?>
</head>

<body>
  <?= $message ?>
  <h1>Login form</h1>
  <form login" method="post">
    <div>
      <label for="email">Email</label>
      <input type="email" name="email" id="email" />
    </div>
    <div>
      <label for="pass">Password</label>
      <input type="password" name="pass" id="pass">
    </div>
    <button type="submit" name="submitBtn">Login</button>
  </form>
</body>

</html>