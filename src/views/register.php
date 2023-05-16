<?php
if (isset($_POST['submitBtn'])) {
  // $status = Auth::register($_db->instance, $_POST['email'], $_POST['name'], $_POST['pass']);
  $status = true;
  if ($status == true)
    header("Location: " . URL . '/dev');
}
?>
<html>

<head>
  <?php
  Template::getHeadlessHead("Register - Astel", "Register form");
  ?>

</head>

<body>
  <style>
    body {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100dvh;
    }

    body>section.form-wrapper {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100dvh;
      background-color: var(--color-background);
      padding: 0 50px;
    }

    form {
      display: flex;
      flex-direction: column;
      max-width: fit-content;
      min-width: 300px;
      gap: var(--p-2);
    }

    form>section {
      display: flex;
      flex-direction: row;
      gap: var(--p-4);
    }

    form>section>label {
      flex-grow: 1;
      text-align: end;
    }
  </style>
  <section class="form-wrapper">
    <h1>Create New Account</h1>
    <p>just pressing few clicks</p>
    <form action="" method="post">
      <section>
        <label for="email">Email</label>
        <input type="email" required name="email" id="email" />
      </section>
      <section>
        <label for="name">Name</label>
        <input type="text" name="name" required id="name" />
      </section>
      <section>
        <label for="pass">Password</label>
        <input type="password" minlength="8" name="pass" id="pass">
      </section>
      <button type="submit" name="submitBtn">Register</button>
      <a class="btn btn-secondary" href=<?= get_base_url() . '/login' ?>>Back to login</a>
    </form>
  </section>
  <?php

  ?>
</body>

</html>