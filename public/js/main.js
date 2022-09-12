const ham = $('#menubtn');
const nav = $('#js-ham');
const tag = $('#searchTag');
ham.on('click', function () {
  ham.toggleClass('active');
  nav.toggleClass('active');
  tag.toggleClass('active');
})

function formSwitch() {
  search_tab = document.getElementsByName('search-tab')
  if (search_tab[0].checked) {
    document.getElementById('tagForm').style.display = "";
    document.getElementById('areaForm').style.display = "none";
    document.getElementById('keywordForm').style.display = "none";
  } else if (search_tab[1].checked) {
    document.getElementById('tagForm').style.display = "none";
    document.getElementById('areaForm').style.display = "";
    document.getElementById('keywordForm').style.display = "none";
  } else if (search_tab[2].checked) {
    document.getElementById('tagForm').style.display = "none";
    document.getElementById('areaForm').style.display = "none";
    document.getElementById('keywordForm').style.display = "";
  };
}

const list = $('#tagList');
const resultTag = $('#resultTag');
list.on('click', function () {
  resultTag.slideToggle();
});

function changeColor(area){
  if( area.value == 0 ){
    area.style.color = '';
  }else{
    area.style.color = '#000000';
  }
}

window.addEventListener('load', formSwitch());
