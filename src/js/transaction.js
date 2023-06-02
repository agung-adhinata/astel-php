"use strict"
const FULLURL = 'http://localhost/api'
document.addEventListener('alpine:init', () => {
  Alpine.data("transaction", () => ({
    isGroupModalOpen: false,
    currentId: null,
    loading: false,
    isEmpty: false,

    postList: [],
    groupList: [],

    newGroupName: "",
    titleTransactionForm: "Tambah Transaksi",
    btnSubmitTitleTransactionForm: "Publish",
    formSubmitType: "edit",
    formName: "",
    formValue: 0,
    formDesc: "",
    formType: "",
    formGroup: "",

    async searchItem() {
      console.log("work")
      this.loading = true
      await fetch(FULLURL + `?month=${month}&name=${title}`).then(response => response.json()).then(data => console.log(data))
      this.loading = false
      if (this.post.length == 0) {
        this.isEmpty = true
      } else {
        this.isEmpty = false
      }
    },
    postNewGroup() {
      if (this.newGroupName.length == 0) {
        return
      }
      fetch(FULLURL + '/postGroup.php', {
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
    postTransaction() {
      const data = {
        name: this.formName,
        value: this.formValue,
        desc: this.formDesc,
        type: this.formType,
        group: this.formGroup
      }
      console.log(data)
      // fetch(url, {
      //   method: "POST",
      //   headers: {
      //     'Accept': 'application/json',
      //     'Content-Type': 'application/json'
      //   },
      //   body: data
      // })
    }
  }))
})