function toHalfWidth(elm) {
    elm.value = elm.value.replace(/[０-９]/g, function(s){
    return String.fromCharCode(s.charCodeAt(0)-0xFEE0);
    }).replace(/[^0-9]/gi, '');
};

$('input').on('change', function () {
    const file = $(this).prop('files')[0];
    $('#img_name').text(file.name);
});