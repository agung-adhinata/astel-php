"use strict"
const FULLURL = 'http://localhost/api'
document.addEventListener('alpine:init', () => {
  Alpine.data("pengguna", () => ({
    editForm: {
      id: "",
      email: "",
      pass: "",
    },

    editMode: false,
    createMode: false,
    showCreateBtn: true,
    penggunaList: [],
    init() {
      this.getPenggunaList()
    },
    editCurrentPengguna(id, email) {
      this.showCreateBtn = false
      this.editMode = true
      this.createMode = false
      this.editForm.id = id
      this.editForm.email = email
    },
    enableCreateMode() {
      this.showCreateBtn = false
      this.editMode = false
      this.createMode = true
      // this.editMode = true
    },
    resetForm() {
      this.createMode = false
      this.editMode = false
      this.showCreateBtn = true
      this.editForm.email = ""
      this.editForm.pass = ""
      this.editForm.id = ""
    },
    getPenggunaList() {
      fetch(FULLURL + '/getPengguna.php').then(resp => resp.json()).then(value => this.penggunaList = value).then(val => console.log(val))
    },
    async updatePengguna() {
      const body = {
        id: this.editForm.id,
        email: this.editForm.email,
        pass: this.editForm.pass,
        role: 0
      }
      console.log(body)
      await fetch(FULLURL + '/postProfil.php', {
        method: "POST",
        body: JSON.stringify(body)
      }).then(response => response.text()).then(value => console.log(value))
      this.getPenggunaList()
    },
    async createPengguna() {
      const body = {
        id: "",
        email: this.editForm.email,
        pass: this.editForm.pass,
        role: 0
      }

      await fetch(FULLURL + '/postProfil.php', {
        method: "POST",
        body: JSON.stringify(body)
      }).then(response => response.json()).then(value => console.log(value))
      this.getPenggunaList()
    },
    async deletePengguna(id) {
      await fetch(FULLURL + '/deleteAccount.php?id=' + id + '&role=' + '1', {
        method: "GET"
      }).then(resp => resp.text()).then(value => console.log(value))
      this.getPenggunaList()
    }
  }))
})