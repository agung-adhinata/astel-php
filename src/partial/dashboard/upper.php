<?php
if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
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
  require ROOT_DIR . '/partial/dashboard/header.php';
  ?>
  <main>
    <?php
    if ($_SESSION['role'] == 0) {
      require ROOT_DIR . '/partial/dashboard/sidebar_admin.php';
    } else if ($_SESSION['role'] == 1) {
      require ROOT_DIR . '/partial/dashboard/sidebar_pengguna.php';
    }
    ?>
    <div class="content">