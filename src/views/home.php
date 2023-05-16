<?php

?>
<html>

<head>
  <?php Template::getHeadlessHead("Astel App", "my description"); ?>

</head>

<body>
  <style>
    body {
      background-color: var(--color-background);
      width: 100%;
    }

    .hero {
      display: flex;
      flex-direction: column;
      width: 100%;
      align-items: center;
      min-height: 100svh;
    }

    .hero>.child {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      flex-grow: 2;
    }

    .child.btns {
      max-width: 300px;
      flex-direction: column;
      gap: 0.5em;
    }
  </style>
  <section class="hero">
    <div class="child">
      <h1> Astel App <i class="fa-solid fa-wallet"></i></h1>
      <p> Personal Finance Manager </p>
    </div>
    <div class="child btns">
      <a href=<?= get_base_url() . '/login' ?> class="btn">
        Login
      </a>
      <a href=<?= get_base_url() . '/register' ?> class="btn btn-secondary">
        Register new account
      </a>
    </div>
  </section>
</body>

</html>