<?php
require ROOT_DIR . '/partial/dashboard/upper.php';
?>
<style>
  .content-list {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }

  .admin-list {
    display: flex;
    flex-direction: column;
    gap: 0.5em;
  }

  .main-list {
    display: flex;
    width: 100%;
    max-height: 100%;

    &:last-child {
      flex-shrink: 1;
    }
  }

  .user-card {
    display: flex;
    /* flex-direction: column; */
    gap: 0.5em;
    padding: 1em;
    border: solid 0.1em var(--color-on-background);
    border-radius: 0.5em;
    max-width: 100%;

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
      justify-content: end;
      align-items: center;
      width: 100%;
    }
  }
</style>
<script src="<?= URL . '/js/pengguna.js' ?>"></script>
<div x-data="pengguna" class="main-list" style="padding: 0 1em;">
  <section class="content-list">
    <h1>
      Pengguna
    </h1>
    <section class="admin-list">
      <template x-for="(value, index) in penggunaList" :key="index">
        <section class="user-card">
          <div class="header small">
          </div>
          <div class="content">
            <div class="h5" style="font-weight: 600;">
              <span x-html="value.email"></span>
            </div>
            <div style="color:gray;">
              <span x-html="value.nama"></span>
            </div>
          </div>
          <div class="footer">
            <button class="btn-square btn-outline" x-on:click="deletePengguna(value.id_pengguna)">
              <i class="fa-solid fa-trash-can"></i>
            </button>
            <button x-on:click="editCurrentPengguna(value.id_pengguna, value.email, value.nama)"
              class="btn-square btn-outline">
              <i class="fa-solid fa-pen-to-square"></i>
            </button>
          </div>
        </section>
      </template>
    </section>
  </section>
  <section>
    <form x-show="editMode" x-on:submit.prevent="updatePengguna()" class="transaction-form">
      <h5>Edit pengguna</h5>
      <input type="email" x-model="editForm.email" placeholder="email pengguna">
      <input type="text" x-model="editForm.nama" placeholder="nama pengguna">
      <input type="password" x-model="editForm.pass" placeholder="new password">
      <button type="submit">Update</button>
      <button type="button" class="btn-outline" x-on:click="resetForm()">Close</button>
    </form>
    <form x-show="createMode" x-on:submit.prevent="createPengguna()" class="transaction-form">
      <h5>Buat akun pengguna</h5>
      <input type="email" x-model="editForm.email" placeholder="email baru">
      <input type="text" x-model="editForm.nama" placeholder="nama baru">
      <input type="password" x-model="editForm.pass" placeholder="password baru">
      <button type="submit">Create</button>
      <button type="button" class="btn-outline" x-on:click="resetForm()">Close</button>
    </form>
    <div x-show="showCreateBtn" class="transaction-form">
      <button class="btn-outline" style="width:100%;" x-on:click="enableCreateMode()">Buat
        akun</button>
    </div>
  </section>
  <section>
  </section>
</div>
<?php
require ROOT_DIR . '/partial/dashboard/lower.php';
?>