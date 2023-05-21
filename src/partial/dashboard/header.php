<header class="flex items-center" style="position:relative;min-height: 3em; width: 100svw; ">
  <a class="h2 flex items-center" style=" gap:0.25em; " href=<?= get_base_url() . '/app' ?>>Astel App <i
      class="fa-solid fa-wallet"></i></a>
  <div>
    <?= $_SESSION['user_id'] ?>
  </div>
</header>