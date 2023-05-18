<?php
if (isset($_SESSION['user_id'])) {
} else {
  header("Location: " . URL . '/api/logout.php');
}
?>

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
      <section class="card-list">
        <a class="btn btn-secondary " href=<?= get_base_url() . '/app/add' ?>>
          <i class="fa-regular fa-rectangle-list"></i>
          Keuangan
        </a>
        <a class="btn btn-secondary" href=<?= get_base_url() . '/app/report' ?>>
          <i class="fa-solid fa-book"></i>
          Laporan
        </a>
        </button>
        <a class="btn btn-secondary" href=<?= get_base_url() . '/app/account' ?>>
          <i class="fa-solid fa-user"></i>
          Akun
        </a>
        <a class="btn btn-secondary" href=<?= get_base_url() . '/api/logout.php' ?>>
          <i class="fa-solid fa-right-from-bracket"></i>
          Log out
        </a>
      </section>
    </aside>
    <div class="content">