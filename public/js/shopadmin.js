$('input').on('change', function () {
    const file = $(this).prop('files')[0];
    $('#img_name').text(file.name);
});