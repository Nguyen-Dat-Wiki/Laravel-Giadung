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

$(document).ready(function() {
    $('#TonKho').change(function() {
        if ($('#TonKho option:selected') != null) {
            $('#Kho').submit();
        }
    })
});

$(document).ready(function() {
    $('#asc_name').change(function() {
        if ($('#asc_name option:selected') != null) {
            $('#Loc').submit();
        }
    })
});

$(document).on('input', '.num_product', function(e) {
    for (let index = 0; index < $('.num_product').length; index++) {
        if ($('.num_product').val() > 0) {
            $('#autoclick').click();
        } else {
            alert('Không được chỉnh về 0');
        }
    }
})

$(document).ready(function() {
    if ($('.owl-clients').length) {
        $('.owl-clients').owlCarousel({
            loop: true,
            nav: false,
            dots: true,
            items: 1,
            margin: 30,
            autoplay: false,
            smartSpeed: 700,
            autoplayTimeout: 6000,
            responsive: {
                0: {
                    items: 1,
                    margin: 0
                },
                460: {
                    items: 1,
                    margin: 0
                },
                576: {
                    items: 2,
                    margin: 20
                },
                992: {
                    items: 3,
                    margin: 30
                }
            }
        });
    }
});

$(document).ready(function() {

    $(document).on('click', '.reply', function() {
        var comment_id = $(this).attr("id");
        $('#comment_id').val(comment_id);
        $('#comment_name').focus();
    });

});