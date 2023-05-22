<form class="transaction-form" method="post">
  <input type="hidden" class="id" name="id" id="formId" value="15246" />
  <span class="h2">Form Keuangan</span>
  <hr />
  <section>
    <label for="formTitle">Judul :</label>
    <input type="text" name="title" id="formTitle" required />
  </section>
  <section>
    <label for="formAmount">Amount :</label>
    <input type="number" name="amount" id="formAmount" required />
  </section>
  <section>
    <textarea name="desc" placeholder="Deskripsi" id="formDesc" rows="4"></textarea>
  </section>
  <hr />
  <fieldset>
    <legend>Pilih tipe transaksi</legend>
    <div>
      <input type="radio" value="1" id="formIncome" name="type" />
      <label for="income">
        Income
      </label>
    </div>
    <div>
      <input type="radio" value="0" id="formExpense" name="type" />
      <label for="expense">
        expense
      </label>
    </div>
  </fieldset>
  <section>
    <label for="group-select">Grup :</label>
    <select name="group" id="group-select">
      <option value="">--Please choose an option--</option>
      <option value="tabungan">Tabungan</option>
      <option value="investasi">Investasi</option>
      <option value="dompet">Dompet</option>
    </select>
  </section>
  <hr />
  <button type="submit">Update Data</button>
</form>