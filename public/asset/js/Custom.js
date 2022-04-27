jQuery(document).ready(function($) {


    "use strict";

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll < 1) {
            $("header").removeClass("background-header");
        } else if (scroll > 100) {
            $("header").addClass("background-header");
        } else {
            $("header").removeClass("background-header");
        }

    });


});

$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('#scroll').fadeIn();
        } else {
            $('#scroll').fadeOut();
        }
    });
    $('#scroll').click(function() {
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
});

/* $(document).ready(function() {
    $('#TonKho').change(function() {
        if ($('#TonKho option:selected') != null) {
            $('#Kho').submit();
        }
    })
}); */

$(document).ready(function() {
    $('#asc_name').change(function() {
        if ($('#asc_name option:selected') != null) {
            $('#Loc').submit();
        }
    })
});