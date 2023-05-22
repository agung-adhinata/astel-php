"use strict"

function sendForm(url) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", url, true)
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
  fetch()
}



function editTransaction(id, title, description, amount, group, date) {
  const parent = document.querySelector('form.transaction-form')
  parent.querySelector('#id').innerHTML = id
  parent.querySelector('#title').innerHTML = title
  parent.querySelector('#description').innerHTML = description
  parent.querySelector('#amount').innerHTML = amount
}