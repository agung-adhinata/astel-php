"use strict"

function sendForm(url) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", url, true)
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
  fetch()
}

function createTransactionCard({ date, id, group, amount, is_income, author }) {

}