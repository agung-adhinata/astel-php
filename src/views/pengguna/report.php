<?php
require ROOT_DIR . '/partial/dashboard/upper.php';
?>
<div style="padding-left: 1em;">

  <h1>
    Report
  </h1>
  <p>Generate report here</p>
  <div style="display: flex; gap:1em; flex-direction: row;">
    <input x-model="searchForm.month" type="month" x-init="$watch('searchForm.month', value => console.log(value))" />
    <input x-model="searchForm.text" style="flex-grow:1;" type="text">
    <button x-on:click="searchItem()">search</button>
  </div>
</div>
<?php
require ROOT_DIR . '/partial/dashboard/lower.php';
?>