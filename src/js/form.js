"use strict"

function sendForm(url) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", url, true)
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
  fetch()
}



function editTransaction(id, title, description, amount, group, date, is_income) {
  const parent = document.querySelector('form.transaction-form')
  parent.querySelector('#id').value = id
  parent.querySelector('#title').value = title
  parent.querySelector('#description').value = description
  parent.querySelector('#amount').value = amount
  parent.querySelector('#type').value = is_income
}