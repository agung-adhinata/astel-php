<?php
require ROOT_DIR . '/partial/dashboard/upper.php';
?>
<script src="<?= URL . '/js/report.js' ?>"></script>
<div x-data="report" style="padding-left: 1em;">

  <h1>
    Report
  </h1>
  <p>Generate report here</p>
  <form x-effect="updateReportLink()" style="display: flex; gap:1em; flex-direction: row;">
    <input x-model="reportForm.month" type="month" />
    <input type="text" x-model="reportForm.name" placeholder="report name">
    <select x-model="reportForm.group">
      <option x-bind:selected="reportForm.group == ''" value=""> - All Groups - </option>
      <template x-for="(data, index) in groupList" :key="index">
        <option :value="data.id" x-bind:selected="data.id == reportForm.group" x-text="data.nama_grup"></option>
      </template>
    </select>
    <!-- <input x-model="reportForm.group" style="flex-grow:1;" type="text"> -->
    <button>Save report</button>
    <a class="btn btn-outline" target="_blank" x-bind:href="reportHref">Generate Report</a>
  </form>
</div>
<?php
require ROOT_DIR . '/partial/dashboard/lower.php';
?>