const date = new Date();
date.setDate(date.getDate() + 1);

const yyyy = date.getFullYear();
const mm = ("0" + (date.getMonth() + 1)).slice(-2);
const dd = ("0" + date.getDate()).slice(-2);
document.getElementById("tomorrow").value = yyyy + '-' + mm + '-' + dd;