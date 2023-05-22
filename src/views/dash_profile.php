<?php
require ROOT_DIR . '/partial/dashboard/upper.php';
?>
<?php

$result = $_db->query("SELECT profil.nama, akun.email, akun.password FROM profil INNER JOIN pengguna ON profil.id_pengguna = pengguna.id_pengguna INNER JOIN akun ON pengguna.id_akun = akun.id_akun");
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

<h1>
  Dashboard
</h1>
<section>
  <form action="<?= URL . '/api/updateProfil.php' ?>" method="post">
    <section>
      <label for="name">
        Name
      </label>
      <input type="text" value="<?= $sanitize_res['nama'] ?>" name="name" id="name" />
    </section>
    <section>
      <label for="email">
        Email
      </label>
      <input type="email" name="email" value="<?= $sanitize_res['email'] ?>" id="email" />
    </section>
    <section>
      <label for="pass">
        Password
      </label>
      <input type="password" value="<?= $sanitize_res['password'] ?>" name="pass" id="pass" />
    </section>
    <button type="submit" name="submitBtn">Save changes</button>
  </form>
</section>

<?php
require ROOT_DIR . '/partial/dashboard/lower.php';
?>