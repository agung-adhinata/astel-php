<?php
$header_title_admin = '';
if (isset($_SESSION['role']) and $_SESSION['role'] == 0) {
  $header_title_admin = '- Admin';
}
?>
<header class="flex items-center" style="position:relative;min-height: 3em; width: 100svw; ">
  <a class="h2 flex items-center" style=" gap:0.25em; " href=<?= get_base_url() . '/app' ?>>Astel App
    <?= $header_title_admin ?> <i class="fa-solid fa-wallet"></i></a>
  <div>
    <?= $_SESSION['user_id'] ?>
  </div>
</header>