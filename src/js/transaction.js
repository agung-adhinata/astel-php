"use strict"
const FULLURL = 'http://localhost/api'
document.addEventListener('alpine:init', () => {
  Alpine.data("transaction", () => ({
    isGroupModalOpen: false,
    loading: false,
    isEmpty: false,
    incomeTotal: 0,
    expenseTotal: 0,
    total: 0,
    idrFormat: new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'IDR',
    }),

    searchForm: {
      month: "",
      group: "",
      text: "",
    },

    postList: [],
    groupList: [],

    newGroupName: "",
    titleTransactionForm: "Tambah Transaksi",
    btnSubmitTitleTransactionForm: "Publish",
    formCurrentId: null,
    formSubmitType: "edit",
    formName: "",
    formValue: 0,
    formDesc: "",
    formType: "",
    formGroup: "",
    init() {
      this.getGroupsList()
      this.getTransactionList()
    },
    resetSearchForm() {
      this.searchForm.month = ""
      this.searchForm.text = ""
    },
    isIncome(string) {
      console.log(string)
      return string == 'income' ? true : false
    },
    getGroupNameFromID(id) {
      for (const index in this.groupList) {
        if (this.groupList[index].id == id) {
          return this.groupList[index].nama_grup
        }
      }
    },
    useEditTransactionForm(id_transaksi) {
      for (const idx in this.postList) {
        if (this.postList[idx].id_transaksi == id_transaksi) {
          const data = this.postList[idx]
          this.formName = data.nama
          this.formValue = data.jumlah
          this.formDesc = data.deskripsi
          this.formGroup = data.id_grup
          this.formType = data.tipe_transaksi
          this.formCurrentId = data.id_transaksi

          this.titleTransactionForm = "Edit Transaksi"
          this.btnSubmitTitleTransactionForm = "Update Transaksi"
          break
        }
      }
    },
    useCreateTransactionForm() {
      this.formName = ""
      this.formValue = ""
      this.formDesc = ""
      this.formGroup = ""
      this.formType = ""
      this.formCurrentId = null
      this.titleTransactionForm = "Tambah Transaksi"
      this.btnSubmitTitleTransactionForm = "Publish"
    },
    async searchItem() {
      const urlWithParam = new URL(FULLURL + '/getTransaction.php')
      this.loading = true
      if (this.searchForm.month.length > 0) {
        urlWithParam.searchParams.append('date', this.searchForm.month)
      }
      if (this.searchForm.text.length > 0) {
        urlWithParam.searchParams.append('search', this.searchForm.text)
      }
      if (this.searchForm.group.length > 0) {
        urlWithParam.searchParams.append('group', this.searchForm.group)
      }
      console.log(urlWithParam.toString())
      await fetch(urlWithParam.toString(), { method: "GET" }).then(response => response.json()).then(value => {
        this.postList = value.transactions
        this.incomeTotal = value.total_income
        this.expenseTotal = value.total_expense
        this.total = value.total
      })
      this.loading = false
    },
    async postNewGroup() {
      if (this.newGroupName.length == 0) {
        return
      }
      await fetch(FULLURL + '/postGroup.php', {
        method: "POST",
        headers: {
          // 'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          name: this.newGroupName,
          desc: "maya"
        })
      }).then(response => response.json()).catch(e => console.log(e)).then(value => console.log(value))
      this.getGroupsList()
    },
    getGroupsList() {
      fetch(FULLURL + '/getGroup.php', {
        method: "GET"
      }).then(response => response.json()).then(value => this.groupList = value).then(value => { console.log(value) })
    },
    async getTransactionList() {
      this.loading = true
      await fetch(FULLURL + '/getTransaction.php', {
        method: "GET"
      }).then(response => response.json()).then(value => {
        this.postList = value.transactions;
        this.incomeTotal = value.total_income
        this.expenseTotal = value.total_expense
        this.total = value.total
        console.log(value)
      })
      this.loading = false
    },
    async postTransaction() {
      const data = {
        id: this.formCurrentId ? this.formCurrentId : "",
        name: this.formName,
        value: this.formValue,
        desc: this.formDesc,
        type: this.formType,
        group: this.formGroup
      }
      console.log(data)
      await fetch(FULLURL + '/postTransaction.php', {
        method: "POST",
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
      }).then(response => response.json()).then(value => console.log(value))
      this.useCreateTransactionForm()
      this.getTransactionList()
    },
    async deleteTransaction(id) {
      await fetch(FULLURL + '/deleteTransaction.php?id=' + id, {
        method: "GET"
      }).catch(err => console.log(err)).then(response => response.json()).then(value => console.log(value))
      this.getTransactionList()
    }
  }))
})