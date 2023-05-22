<form class="transaction-form" method="post">
  <span class="id">ID:15246</span>
  <span class="h2">Form Keuangan</span>
  <hr />
  <section>
    <label for="title">Judul</label>
    <input type="text" name="title" id="title" required />
  </section>
  <section>
    <label for="amount">Amount</label>
    <input type="number" name="amount" id="amount" required />
  </section>
  <section>
    <textarea name="desc" placeholder="Deskripsi" rows="4"></textarea>
  </section>
  <hr />
  <fieldset>
    <legend>Pilih tipe transaksi</legend>
    <div>
      <input type="radio" id="income" name="type" />
      <label for="income">
        Income
      </label>
    </div>
    <div>
      <input type="radio" id="expense" name="type" />
      <label for="expense">
        expense
      </label>
    </div>
  </fieldset>
  <hr />
  <button type="submit">Update Data</button>
</form>