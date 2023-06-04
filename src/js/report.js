"use strict"
const FULLURL = 'http://localhost/api'
const REPORTURL = 'http://localhost/laporan.php'
document.addEventListener('alpine:init', () => {
  Alpine.data("report", () => ({
    reportForm: {
      name: "",
      desc: "",
      month: "",
      group: "",
    },
    reportHref: "",
    groupList: [],
    reportList: [],
    init() {
      this.getGroupsList()
      this.getReportList()
    },
    getGroupsList() {
      fetch(FULLURL + '/getGroup.php', {
        method: "GET"
      }).then(response => response.json()).then(value => this.groupList = value).then(value => { console.log(value) })
    },
    getReportList() {
      fetch(FULLURL + '/getLaporan.php', {
        method: "GET"
      }).then(response => response.json()).then(value => this.reportList = value).then(value => { console.log(value) })
    },
    async seveReport() {
      const body = {
        judul: this.reportForm.name,
        deskripsi: this.reportForm.desc,
        tanggal: this.reportForm.month,
        idGrup: this.reportForm.group
      }
      console.log(body)
      await fetch(FULLURL + "/postLaporan.php", {
        method: "POST",
        body: JSON.stringify(body)
      }).then(response => response.text()).then(value => console.log(value))
      this.getReportList()
    },
    updateReportLink() {
      const month = this.reportForm.month
      const group = this.reportForm.group
      const urlWithParam = new URL(REPORTURL)
      if (this.reportForm.month.length > 0) {
        urlWithParam.searchParams.append('date', this.reportForm.month)
      }
      if (this.reportForm.group.length > 0) {
        urlWithParam.searchParams.append('group', this.reportForm.group)
      }
      this.reportHref = urlWithParam.toString()
      console.log(urlWithParam.toString())
    }
  }))
})