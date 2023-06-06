<?php
require ROOT_DIR . '/partial/dashboard/upper.php';
?>
<script src="<?= URL . '/js/report.js' ?>"></script>
<div x-data="report" style="display: flex;">
  <section style="flex-grow: 1; padding: 0 1em;">
    <h1>
      Report
    </h1>
    <p>Generate report here</p>
    <section class="transaction-list">
      <template x-for="(value, index) in reportList">
        <a :href="'http://localhost/laporan.php?id='+value.id_laporan +''" target="_blank" class="transaction-card">
          <section class="header">
            <small class="date">DATE:
              <span x-html="new Date(value.tanggal).toLocaleString('default', { month: 'long',year:'numeric' })"></span>
            </small>
          </section>
          <section class="content h1">
            <span x-html="value.judul"></span>
          </section>
        </a>
      </template>
    </section>
  </section>
  <section class="inspector">
    <form x-on:submit.prevent="seveReport()" x-effect="updateReportLink()" class="transaction-form">
      <input x-model="reportForm.month" type="month" />
      <input type="text" x-model="reportForm.name" placeholder="Nama laporan">
      <input type="text" x-model="reportForm.desc" placeholder="Deskripsi">
      <select x-model="reportForm.group">
        <option x-bind:selected="reportForm.group == ''" value=""> - All Groups - </option>
        <template x-for="(data, index) in groupList" :key="index">
          <option :value="data.id" x-bind:selected="data.id == reportForm.group" x-text="data.nama_grup"></option>
        </template>
      </select>
      <!-- <input x-model="reportForm.group" style="flex-grow:1;" type="text"> -->
      <button type="submit">Save report</button>
      <a class="btn btn-outline" target="_blank" x-bind:href="reportHref">Generate Report</a>
    </form>
  </section>
</div>
<?php
require ROOT_DIR . '/partial/dashboard/lower.php';
?>