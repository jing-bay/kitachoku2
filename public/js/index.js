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

window.addEventListener('load', formSwitch());
