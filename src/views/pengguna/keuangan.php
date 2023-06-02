<?php
require ROOT_DIR . '/partial/dashboard/upper.php';
?>
<script src="<?= URL . '/js/transaction.js' ?>"></script>
<section x-data="transaction" @keyup.escape="resetSearchForm()" style="display: flex; height: 100%; max-width: 100%; ">
  <div
    style=" display:flex; flex-direction:column; overflow-y: hidden; flex-grow:1; max-height:100%; padding-right: 1em; padding-left: 1em; ">
    <h1>
      Keuangan
    </h1>
    <section class="font-mono " style="display:flex; flex-direction:column; width: 100%; margin-bottom: 1em; ">
      <div style="flex-grow: 1; display: inherit; flex-direction: column; ">
        <div style="display:flex; ">
          <span style="flex-grow:1;">keuangan saat ini :</span>
          <span x-html="idrFormat.format(total)"></span>
        </div>
        <div style="display:flex; ">
          <span style="flex-grow:1;">income total :</span>
          <span x-html="idrFormat.format(incomeTotal)"></span>
        </div>
        <div style="display:flex; ">
          <span style="flex-grow:1;">expense total :</span>
          <span x-html="idrFormat.format(expenseTotal)"></span>
        </div>
      </div>
      <div style="display: flex; gap:1em; flex-direction: row;">
        <input x-model="searchForm.month" type="month"
          x-init="$watch('searchForm.month', value => console.log(value))" />
        <input x-model="searchForm.text" style="flex-grow:1;" type="text">
        <button x-on:click="searchItem()">search</button>
      </div>
    </section>
    <section class="transaction-list" style="overflow-y:scroll;">
      <template x-for="(post, index) in postList" :key="index">
        <div class="transaction-card">
          <section class="header">
            <small class="date">DATE: <span x-html="post.tanggal">None</span></small>
            <small class="group">GROUP:<span x-html="getGroupNameFromID(post.id_grup)">None</span></small>
            <small class="id">ID: <span x-html="post.id_transaksi">19445678E</span></small>
          </section>
          <section class="info">
          </section>
          <section class="content h1">
            <template x-if="isIncome(post.tipe_transaksi)">
              <i style="color: green;" class="fa-solid fa-angles-up"></i>
            </template>
            <template x-if="!isIncome(post.tipe_transaksi)">
              <i style="color: red;" class="fa-solid fa-angles-down"></i>
            </template>
            <span class="amount" x-html="idrFormat.format(post.jumlah)">IDR 50.000</span>
          </section>
          <section class="footer">
            <span class="title">
              <span class="h5" style="font-weight: 800;" x-html="post.nama">Hutank</span>
              <span> - </span>
              <span x-html="post.deskripsi"></span>
            </span>
            <div class="action">
              <button x-on:click="deleteTransaction(post.id_transaksi)" class="btn-square btn-outline">
                <i class="fa-solid fa-trash-can"></i>
              </button>
              <button x-on:click="useEditTransactionForm(post.id_transaksi)" class="btn-square btn-outline">
                <i class="fa-solid fa-pen-to-square"></i>
              </button>
            </div>
          </section>
        </div>
      </template>
      <template x-if="postList.length == 0">
        <h5 style=" text-align: center; color:gray; ">ψ(._. )> Transaksi Kosong ...ψ</h5>
      </template>
      <template x-if="loading">
        <h5 style=" text-align: center; color:gray; ">...ψ</h5>
      </template>
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