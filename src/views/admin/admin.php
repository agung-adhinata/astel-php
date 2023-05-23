<?php
require ROOT_DIR . '/partial/dashboard/upper.php';
?>
<style>
  .user-card {
    display: flex;
    flex-direction: column;
    gap: 0.5em;
    padding: 1em;
    border: solid 0.1em var(--color-on-background);
    border-radius: 0.5em;
    max-width: 300px;

    & .is-you {
      background-color: #bada55;
      padding: 0 1em;
    }

    &>.header {
      font-family: var(--font-mono);
      display: flex;
      flex-direction: row;
      justify-content: space-between;
    }

    &>.footer {
      display: inherit;
      gap: 0.25em;
      align-items: center;
    }
  }
</style>
<div style="padding: 0 1em;">
  <h1>
    Admin
  </h1>
  <section class="user-card">
    <div class="header small">
      <span>ID:1</span>
      <span class="is-you">THIS IS YOU</span>
    </div>
    <div class="content">
      EMAIL: admin@astel.com
    </div>
    <div class="footer">
      <button class="btn-square btn-outline" disabled>
        <i class="fa-solid fa-trash-can"></i>
      </button>
      <button class="btn-square btn-outline">
        <i class="fa-solid fa-pen-to-square"></i>
      </button>
    </div>
  </section>
</div>
<?php
require ROOT_DIR . '/partial/dashboard/lower.php';
?>