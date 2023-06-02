<div class="inspector" x-init="getGroupsList()">
  <form x-on:submit.prevent="postTransaction()" class="transaction-form" method="post">
    <span x-html="titleTransactionForm" class="h2"></span>
    <hr />
    <section>
      <label for="formTitle">Judul :</label>
      <input type="text" name="title" x-model="formName" id="formTitle" required />
    </section>
    <section>
      <label for="formAmount">Amount :</label>
      <input type="number" name="amount" x-model="formValue" id="formAmount" required />
    </section>
    <section>
      <textarea name="desc" x-model="formDesc" placeholder="Deskripsi" id="formDesc" rows="4"></textarea>
    </section>
    <hr />
    <fieldset x-model="formType" x-init="$watch('formType', value => console.log(value))">
      <legend>Pilih tipe transaksi</legend>
      <div>
        <input type="radio" value="income" id="formIncome" name="type" />
        <label for="income">
          Income
        </label>
      </div>
      <div>
        <input type="radio" value="expense" id="formExpense" name="type" />
        <label for="expense">
          expense
        </label>
      </div>
    </fieldset>
    <section>
      <label for="group-select">Grup :</label>
      <select x-model="formGroup" name="group" id="group-select">
        <option value="">--Please choose an option--</option>
        <template x-for="(data, index) in groupList" :key="index">
          <option value="data.nama_grup" x-text="data.nama_grup"></option>
        </template>
      </select>
    </section>
    <section>
      <button x-on:click="isGroupModalOpen = true" type="button" id="btnToggleGroupList" class="btn-secondary"
        style="min-width:100%;">
        <span> Add group </span>
      </button>

    </section>
    <hr />
    <button x-html="btnSubmitTitleTransactionForm" type="submit"></button>
  </form>

  <form x-on:submit.prevent="postNewGroup()" class="transaction-form" role="dialog" x-transition x-cloak
    x-show="isGroupModalOpen">
    <h3>Tambah grup</h3>
    <section>
      <label for="name">Nama</label>
      <input type="text" x-model="newGroupName" name="name" id="name" required />
    </section>
    <button aria-label="Close" x-on:click="isGroupModalOpen=false">✖</button>
  </form>
</div>