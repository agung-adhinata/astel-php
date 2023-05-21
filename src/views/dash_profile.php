<?php
require_once ROOT_DIR . 'config.php';

$result = $GLOBALS['_db']->query("SELECT profil.nama, akun.email");
if (mysqli_num_rows($result) < 1) {

}
$sanitize_res = $result->fetch_array();
?>
<?php
require ROOT_DIR . '/partial/dashboard/upper.php';
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
  <form method="post">
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
        New Password
      </label>
      <input type="password" name="pass" id="pass" />
    </section>
    <button type="submit">Save changes</button>
  </form>
</section>

<?php
require ROOT_DIR . '/partial/dashboard/lower.php';
?>