const ham = $('#menubtn');
const nav = $('#js-ham');
const tag = $('#searchTag');
ham.on('click', function () {
  ham.toggleClass('active');
  nav.toggleClass('active');
  tag.toggleClass('active');
});

function formSwitch() {
  hoge = document.getElementsByName('search-tab')
  if (hoge[0].checked) {
    document.getElementById('tagForm').style.display = "";
    document.getElementById('areaForm').style.display = "none";
    document.getElementById('keywordForm').style.display = "none";
  } else if (hoge[1].checked) {
    document.getElementById('tagForm').style.display = "none";
    document.getElementById('areaForm').style.display = "";
    document.getElementById('keywordForm').style.display = "none";
  } else if (hoge[2].checked) {
    document.getElementById('tagForm').style.display = "none";
    document.getElementById('areaForm').style.display = "none";
    document.getElementById('keywordForm').style.display = "";
  }
}

window.addEventListener('load', formSwitch());
