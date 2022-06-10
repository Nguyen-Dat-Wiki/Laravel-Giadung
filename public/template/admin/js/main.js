$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url) {
    if (confirm('Xóa mà không thể khôi phục. Bạn có chắc ?')) {
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: { id },
            url: url,
            success: function(result) {
                if (result.error === false) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert('Xóa lỗi vui lòng thử lại');
                }
            }
        })
    }
}

$(document).ready(function() {
    $(".show-column-footer").hide();
    $('.hide-column').click(function(e) {
        var $btn = $(this);
        var $cell = $btn.closest('th,td')
        var $table = $btn.closest('table')

        // get cell location - https://stackoverflow.com/a/4999018/1366033
        var cellIndex = $cell[0].cellIndex + 1;

        $table.find(".show-column-footer").show()
        $table.find("tbody tr, thead tr")
            .children(":nth-child(" + cellIndex + ")")
            .hide()
    })

    $(".show-column-footer").click(function(e) {
        var $table = $(this).closest('table')
        $table.find(".show-column-footer").hide()
        $table.find("th, td").show()

    })

});

/*Upload File */
$('#upload').change(function() {
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);

    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        dataType: 'JSON',
        data: form,
        url: '/admin/upload/services',
        success: function(results) {
            if (results.error === false) {
                $('#image_show').html('<a href="' + results.url + '" target="_blank">' +
                    '<img src="' + results.url + '" width="100px"></a>');

                $('#thumb').val(results.url);
            } else {
                alert('Upload File Lỗi');
            }
        }
    });
});