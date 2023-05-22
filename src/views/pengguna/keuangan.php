<?php
require ROOT_DIR . '/partial/dashboard/upper.php';
?>
<style>
</style>
<section style="display: flex; height: 100%;">
  <div style="flex-grow: 1; overflow-y: auto;">
    <h1>
      Keuangan
    </h1>
    <p>List keuangan selama 30 hari</p>
    <section class="transaction-list">
      <div class="transaction-card">
        <section class="header">
          <small class="date">DATE: <span id="date">2022/08/02</span></small>
          <small class="group">GROUP:<a id="group" href="#">DOMPET</a></small>
          <small class="id">ID: <span id="id">19445678E</span></small>
        </section>
        <section class="info">
        </section>
        <section class="content h1">
          <i class="fa-solid fa-angles-up"></i>
          <span class="amount">IDR 50.000</span>
        </section>
        <section class="footer">
          <span class="title h5">Hutank</span>
          <span class="action">
            <button class="btn-square btn-outline">
              <i class="fa-regular fa-trash-can"></i>
            </button>
            <button class="btn-square btn-outline">
              <i class="fa-solid fa-pen-to-square"></i>
            </button>
          </span>
        </section>
      </div>
    </section>
  </div>
  <?php require ROOT_DIR . '/partial/dashboard/form_keuangan.php'; ?>
</section>
<script>
  "use strict"
</script>
<?php
require ROOT_DIR . '/partial/dashboard/lower.php';
?>