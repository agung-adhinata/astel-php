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
          <i class="fa-solid fa-plus"></i>
          Tambah Keuangan
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
        <a class="btn btn-secondary" href=<?= get_base_url() . '/login' ?>>
          <i class="fa-solid fa-right-from-bracket"></i>
          Log out
        </a>
      </section>
    </aside>
    <div class="content">
      <h1>
        Dashboard
      </h1>

    </div>
  </main>
  <footer>
    <h2>
      Footer section
    </h2>
  </footer>
</body>

</html>