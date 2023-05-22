<?php
?>
<div class="transaction-card">
  <section class="header">
    <small class="date">DATE: <span id="date">
        <?= $date ?>
      </span></small>
    <small class="group">GROUP:<a id="group" href="#">
        <?= $group ?>
      </a></small>
    <small class="id">ID: <span id="id">
        <?= $id_transaksi ?>
      </span></small>
  </section>
  <section class="info">
  </section>
  <section class="content h1">
    <?php
    if ($is_income) {
      echo "<i class=\"fa-solid fa-angles-up\"></i>";
    } else {
      echo "<i class=\"fa-solid fa-angles-down\"></i>";
    }
    ?>
    <span class="amount">
      <?= $amount ?>
    </span>
  </section>
  <section class="footer">
    <span class="title h5">
      <?= $title ?>
    </span>
    <span class="action">
      <button class="btn-square btn-outline">
        <i class="fa-regular fa-trash-can"></i>
      </button>
      <button
        onclick="editTransaction(<?= $id_transaksi ?>, <?= $title ?>,<?= $desc ?>, <?= $amount ?>, <?= $group ?>, <?= $date ?>)"
        class="btn-square btn-outline">
        <i class="fa-solid fa-pen-to-square"></i>
      </button>
    </span>
  </section>
</div>