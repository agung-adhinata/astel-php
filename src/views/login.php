<html>

<head>
  <?php
  Template::getHeadlessHead("Login - Astel", "Login form");
  ?>
  <link rel="stylesheet" href="style/main.css" type="text/css" />
</head>

<body class="bg-pattern">
  <?= $message ?>
  <style>
    body {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 100dvh;
      background-image: url("../assets/doodle.png");
      background-size: 500px 500px;
      background-repeat: repeat;
    }

    body>.form-wrapper {
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
    <h1>Login form</h1>
    <form method="post">
      <section>
        <label for="email">Email</label>
        <input type="email" required name="email" id="email" />
      </section>
      <section>
        <label for="pass">Password</label>
        <input type="password" required name="pass" id="pass">
      </section>
      <button type="submit" name="submitBtn">Login</button>
      <a class="btn btn-secondary" href=<?= get_base_url() . '/register' ?>>Create new account?</a>
    </form>
  </section>
</body>

</html>