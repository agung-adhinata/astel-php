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
    init() {
      this.getGroupsList()
    },
    getGroupsList() {
      fetch(FULLURL + '/getGroup.php', {
        method: "GET"
      }).then(response => response.json()).then(value => this.groupList = value).then(value => { console.log(value) })
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