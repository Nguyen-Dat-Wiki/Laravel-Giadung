$(document).ready(function($) {


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
// thay đổi số lượng cart
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
// comment
$(document).ready(function() {

    $(document).on('click', '.reply', function() {
        var comment_id = $(this).attr("id");
        $('#comment_id').val(comment_id);
        $('#comment_name').focus();
    });

});
// button thay đổi
$(document).ready(function() {
    $(document).on('click', '#Vnpay', function() {
        $('#redirect').removeClass('d-none');
        $('#thanhtoan').addClass('d-none');
        $('#redirect2').addClass('d-none');
    })
    $(document).on('click', '#MV', function() {
        $('#thanhtoan').removeClass('d-none');
        $('#redirect').addClass('d-none');
        $('#redirect2').addClass('d-none');

    })
    $(document).on('click', '#Momo', function() {
        $('#thanhtoan').addClass('d-none');
        $('#redirect').addClass('d-none');
        $('#redirect2').removeClass('d-none');

    })
});

function Seen(product_id) {

    var id = product_id;
    var name = $('#name' + product_id).val();
    var url = $('#url' + product_id).val();
    var price = $('#price' + product_id).val();
    var price_old = $('#price_old' + product_id).val();
    var thumb = $('#thumb' + product_id).val();
    var sale = $('#sale' + product_id).val();
    var token = $('#token' + product_id).val();

    var item = {
        'id': id,
        'url': url,
        'sale': sale,
        'thumb': thumb,
        'price': price,
        'price_old': price_old,
        'name': name,
        'token': token,
    }
    var count = 0;
    var old_data = JSON.parse(localStorage.getItem('seen'));
    if (old_data.length == 0) {
        old_data.push(item);
        window.localStorage.unloadTime = JSON.stringify(new Date());

    } else {
        old_data.forEach((test) => {
            if (test.id !== item.id) {
                count++;
            }
        });
        if (count == old_data.length) {
            old_data.unshift(item);
            window.localStorage.unloadTime = JSON.stringify(new Date());
        }
    }
    localStorage.setItem('seen', JSON.stringify(old_data));
}


$(document).ready(function() {
    // xoá lịch sử xem nếu 3 ngày không sử dụng website
    let loadTime = new Date();
    let unloadTime = new Date(JSON.parse(localStorage.getItem("unloadTime")));
    if (loadTime.getTime() - unloadTime.getTime() > 259200000) {
        localStorage.removeItem("seen");
    }
    // render lịch sử 
    const seen_item = document.querySelector(".seen");
    const data = JSON.parse(localStorage.getItem("seen"))
    $.each(data, function(i, product) {
        if (i == 5) {
            return false;
        } else {
            seen_item.innerHTML += `
                        <div class="card">
                    <form action="/add-cart" method="post">
                        <div class="card-body"> 
                            <div class="card-img">
                                <a href="${product.url}"><img class="img-product" src="${product.thumb}" alt="..."></a>
                                <span class="sale">-${product.sale}%</span>
                            </div>
                            <div class="card-top">
                                <h3 class="card-title" style="text-align: center;"><a href="${product.url}"  style="color: black;">${product.name}</a></h3>
                            </div>
                            <p class="card-user">
                                <span class="moneyold">${product.price}đ</span>&nbsp;&nbsp;
                                <span class="moneysale">${product.price_old}đ</span>
                            </p>
                            <div class="button-submit d-flex justify-content-center"><button class="bg-white border-primary text-dark" type="submit">Mua ngay&nbsp; <i class="fa-solid fa-basket-shopping-simple"></i></button></div>
                        </div>
                        <input type="number" name="num_product" hidden value="1">
                        <input type="hidden" name="_token" hidden value="${product.token}">
                        <input type="hidden" name="product_id" value="${product.id}">
                    </form>
            `
        }
    })

});