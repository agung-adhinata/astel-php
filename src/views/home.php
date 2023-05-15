<?php

?>
<html>

<head>
  <?php Template::getHeadlessHead("my title", "my description"); ?>
  <link rel="stylesheet" href="style/home.css" />
</head>

<body>
  <style>
    .hero {
      display: flex;
      flex-direction: row;
    }

    .hero>.child {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
  </style>
  <section class="hero">
    <div class="child">
      <h1> Astel App </h1>
    </div>
    <div class="child">
      <h1> Astel 2 </h1>
    </div>
  </section>
</body>

</html>