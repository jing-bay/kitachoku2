const ham = $('#menubtn');
const nav = $('#js-ham');
const tag = $('#searchTag');
ham.on('click', function () {
  ham.toggleClass('active');
  nav.toggleClass('active');
  tag.toggleClass('active');
})