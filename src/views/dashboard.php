<html>

<head>
  <?php
  Template::getHeadlessHead("Dashboard", "dashboard");
  ?>
  <link rel="stylesheet" href="/style/dashboard.css">
</head>

<body>
  <?php
  require ROOT_DIR . '/partial/dashboard_header.php';
  ?>
  <main>
    <aside>
      <nav>
        <a href=<?= get_base_url() . '/app/' ?>>Overview</a>
        <a href=<?= get_base_url() . '/app/transaction' ?>>Transactions</a>
        <a href=<?= get_base_url() . '/app/report' ?>>Report</a>
        <a href=<?= get_base_url() . '/app/settings' ?>>Settings</a>
      </nav>
    </aside>
    <h1>
      Dashboard section
    </h1>
  </main>
  <footer>
    <h2>
      Footer section
    </h2>
  </footer>
</body>

</html>