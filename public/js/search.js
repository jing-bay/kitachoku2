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