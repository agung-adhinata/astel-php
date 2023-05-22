"use strict"

function sendForm(url) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", url, true)
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
  fetch()
}

function editTransaction(id, title, description, amount, group, date, is_income) {
  const parent = document.querySelector('form.transaction-form')
  parent.querySelector('#formId').value = id
  parent.querySelector('#formTitle').value = title
  parent.querySelector('#formAmount').value = amount
  parent.querySelector('#formDesc').value = description
  parent.querySelector('#formType').value = is_income
  parent.querySelector('#formGroup').value = group
  parent.querySelector('#formDate').value = new Date(date)
}