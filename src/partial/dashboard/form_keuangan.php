<div class="inspector">
  <form x-on:submit.prevent="postTransaction()" class="transaction-form" method="post">
    <span x-html="titleTransactionForm" class="h2"></span>
    <hr />
    <section style="gap:0.5em;" x-effect="console.log(formDate + ' ' + formTime)">
      <input type="date" style="flex-grow: 1;" x-model="formDate" required id="formDate" />
      <input type="time" x-model="formTime" required />
    </section>
    <hr />
    <section>
      <label for="formTitle">Judul :</label>
      <input type="text" name="title" x-model="formName" id="formTitle" required />
    </section>
    <section>
      <label for="formAmount">Jumlah (Rp.) :</label>
      <input type="number" name="amount" x-model="formValue" id="formAmount" required />
    </section>
    <section>
      <textarea name="desc" x-model="formDesc" placeholder="Deskripsi" id="formDesc" rows="4"></textarea>
    </section>
    <hr />
    <fieldset x-model="formType" x-init="$watch('formType', value => console.log(value))">
      <legend>Pilih tipe transaksi</legend>
      <div>
        <input type="radio" x-bind:checked="formType == 'income'" :value="'income'" id="formIncome" name="type" />
        <label for="income">
          Pemasukan
        </label>
      </div>
      <div>
        <input type="radio" :value="'expense'" x-bind:checked="formType == 'expense'" id="formExpense" name="type" />
        <label for="expense">
          Pengeluaran
        </label>
      </div>
    </fieldset>
    <section>
      <label for="group-select">Grup :</label>
      <select x-model="formGroup" name="group" id="group-select">
        <option x-bind:selected="formGroup == ''" value="">-- Pilih opsi berikut --</option>
        <template x-for="(data, index) in groupList" :key="index">
          <option :value="data.id" x-bind:selected="data.id == formGroup" x-text="data.nama_grup"></option>
        </template>
      </select>
    </section>
    <section>
      <button x-on:click="isGroupModalOpen = true" type="button" id="btnToggleGroupList" class="btn-secondary"
        style="min-width:100%;">
        <span> Add group </span>
      </button>

    </section>
    <button x-transition class="btn-outline" x-show="formCurrentId != null" x-on:click="useCreateTransactionForm()"
      type="button">Switch to Create</button>
    <hr />
    <button x-html="btnSubmitTitleTransactionForm" type="submit"></button>
  </form>

  <form style="margin-top:0.5em;" x-on:submit.prevent="postNewGroup()" class="transaction-form" role="dialog"
    x-transition x-cloak x-show="isGroupModalOpen">
    <hr />
    <h6 style=" margin-top: 0; ">Group Editor</h6>
    <section>
      <label for="name">Nama</label>
      <input type="text" x-model="newGroupName" name="name" id="name" required />
    </section>
    <button aria-label="Close" x-on:click="isGroupModalOpen=false">✖</button>
  </form>
</div>