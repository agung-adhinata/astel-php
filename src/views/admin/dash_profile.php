<?php
require ROOT_DIR . '/partial/dashboard/upper.php';
?>
<?php

$result = $_db->query("SELECT password FROM akun where id_akun = '{$_SESSION['user_id']}'");
if ($result && mysqli_num_rows($result) < 1) {

}
$sanitize_res = $result->fetch_array();
?>
<style>
  form {
    display: flex;
    flex-direction: column;
    max-width: fit-content;
    min-width: 300px;
    gap: var(--p-2);
  }

  form>section {
    display: flex;
    flex-direction: row;
    gap: var(--p-4);
  }

  form>section>label {
    flex-grow: 1;
    text-align: end;
  }
</style>
<div style="padding-left: 1em;">
  <h1>
    Dashboard
  </h1>
  <section>
    <form action="<?= URL . '/api/updateProfil.php' ?>" method="post">
      <section>
        <label for="pass">
          Password
        </label>
        <input type="password" value="<?= $sanitize_res['password'] ?>" name="pass" id="pass" />
      </section>
      <button type="submit" name="submitBtn">Save changes</button>
    </form>
  </section>
</div>

<?php
require ROOT_DIR . '/partial/dashboard/lower.php';
?>