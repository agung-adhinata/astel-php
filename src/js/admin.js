"use strict"
const FULLURL = 'http://localhost/api'
document.addEventListener('alpine:init', () => {
  Alpine.data("admin", () => ({
    editForm: {
      id: "",
      email: "",
      pass: "",
    },

    editMode: false,
    createMode: false,
    showCreateBtn: true,
    adminList: [],
    init() {
      this.getAdminList()
    },
    editCurrentAdmin(id, email) {
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
    getAdminList() {
      fetch(FULLURL + '/getAdmin.php').then(resp => resp.json()).then(value => this.adminList = value).then(val => console.log(val))
    },
    async updateAdmin() {
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
      this.getAdminList()
    },
    async createAdmin() {
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
      this.getAdminList()
    },
    async deleteAdmin(id) {
      await fetch(FULLURL + '/deleteAccount.php?id=' + id + '&role=' + '0', {
        method: "GET"
      }).then(resp => resp.text()).then(value => console.log(value))
      this.getAdminList()
    }
  }))
})