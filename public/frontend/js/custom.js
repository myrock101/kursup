// === Dropdown === //
"use strict";
$('.ui.dropdown')
    .dropdown();

// === Model === //
$('.ui.modal')
    .modal({
        blurring: true
    })
    .modal('show');

// === Tab === //
$('.menu .item')
    .tab();

// === checkbox Toggle === //
$('.ui.checkbox')
    .checkbox();

// === Toggle === //
$('.enable.button')
    .on('click', function () {
        $(this)
            .nextAll('.checkbox')
            .checkbox('enable');
    });

// Home Live Stream
// $('.live_stream').owlCarousel({
//     items: 10,
//     loop: false,
//     margin: 10,
//     nav: true,
//     dots: false,
//     navText: ["<i class='uil uil-angle-left'></i>", "<i class='uil uil-angle-right'></i>"],
//     responsive: {
//         0: {
//             items: 2
//         },
//         600: {
//             items: 3
//         },
//         1000: {
//             items: 3
//         },
//         1200: {
//             items: 5
//         },
//         1400: {
//             items: 6
//         }
//     }
// })

// Featured Courses home
$('.featured_courses').owlCarousel({
    items: 10,
    loop: false,
    margin: 15,
    nav: true,
    dots: false,
    navText: ["<i class='uil uil-angle-left'></i>", "<i class='uil uil-angle-right'></i>"],
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 3
        },
        1200: {
            items: 5
        }
    }
})

// Featured Courses home
$('.top_instrutors').owlCarousel({
    items: 10,
    loop: false,
    margin: 15,
    nav: true,
    dots: false,
    navText: ["<i class='uil uil-angle-left'></i>", "<i class='uil uil-angle-right'></i>"],
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 3
        },
        1200: {
            items: 5
        }
    }
})

// Student Says
// $('.Student_says').owlCarousel({
//     items: 10,
//     loop: false,
//     margin: 30,
//     nav: true,
//     dots: false,
//     navText: ["<i class='uil uil-angle-left'></i>", "<i class='uil uil-angle-right'></i>"],
//     responsive: {
//         0: {
//             items: 1
//         },
//         600: {
//             items: 2
//         },
//         1000: {
//             items: 2
//         },
//         1200: {
//             items: 3
//         },
//         1400: {
//             items: 3
//         }
//     }
// })

// features Careers
$('.feature_careers').owlCarousel({
    items: 4,
    loop: false,
    margin: 20,
    nav: true,
    dots: false,
    navText: ["<i class='uil uil-angle-left'></i>", "<i class='uil uil-angle-right'></i>"],
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 3
        },
        1200: {
            items: 5
        }
    }
})

/*Floating Code for Iframe Start*/
if (jQuery('iframe[src*="https://www.youtube.com/embed/"],iframe[src*="https://player.vimeo.com/"],iframe[src*="https://player.vimeo.com/"]').length > 0) {
    /*Wrap (all code inside div) all vedio code inside div*/
    jQuery('iframe[src*="https://www.youtube.com/embed/"],iframe[src*="https://player.vimeo.com/"]').wrap("<div class='iframe-parent-class'></div>");
    /*main code of each (particular) vedio*/
    jQuery('iframe[src*="https://www.youtube.com/embed/"],iframe[src*="https://player.vimeo.com/"]').each(function (index) {

        /*Floating js Start*/
        var windows = jQuery(window);
        var iframeWrap = jQuery(this).parent();
        var iframe = jQuery(this);
        var iframeHeight = iframe.outerHeight();
        var iframeElement = iframe.get(0);
        windows.on('scroll', function () {
            var windowScrollTop = windows.scrollTop();
            var iframeBottom = iframeHeight + iframeWrap.offset().top;

            if ((windowScrollTop > iframeBottom)) {
                iframeWrap.height(iframeHeight);
                iframe.addClass('stuck');
                jQuery(".scrolldown").css({
                    "display": "none"
                });
            } else {
                iframeWrap.height('auto');
                iframe.removeClass('stuck');
            }
        });
        /*Floating js End*/
    });
}

/*Floating Code for Iframe End*/

// expand/collapse all Start

var headers = $('#accordion .accordion-header');
var contentAreas = $('#accordion .ui-accordion-content ').hide()
    .first().show().end();
var expandLink = $('.accordion-expand-all');

// add the accordion functionality
headers.on('click', function () {
    // close all panels
    contentAreas.slideUp();
    // open the appropriate panel
    $(this).next().slideDown();
    // reset Expand all button
    expandLink.text('Expand all')
        .data('isAllOpen', false);
    // stop page scroll
    return false;
});

// hook up the expand/collapse all
expandLink.on('click', function () {
    var isAllOpen = !$(this).data('isAllOpen');

    contentAreas[isAllOpen ? 'slideDown' : 'slideUp']();

    expandLink.text(isAllOpen ? 'Collapse All' : 'Expand all')
        .data('isAllOpen', isAllOpen);
});

// Payment Method Accordion
$('input[name="paymentmethod"]').on('click', function () {
    var $value = $(this).attr('value');
    $('.return-departure-dts').slideUp();
    $('[data-method="' + $value + '"]').slideDown();
});

$('.custom-file-input').on('change', function () {
    var file = $(this)[0].files[0].name;

        var idxDot = file.lastIndexOf(".") + 1;
        var extFile = file.substr(idxDot, file.length).toLowerCase();
        if (extFile == "php") {
            $(this).val('');
            $(this).next('label').text("No Choose");
            alert("PHP files are not allowed!");

        } else{

            $(this).next('label').text(file);
        }
});


$("input").on('keyup', function () {
    var str = $(this).val();
    var s = str.search("<script>");
    var e = str.search("</script>");

    if (s > -1 || e > -1) {
        $(this).val("")
    }

});
$("textarea").on('keyup', function () {
    var str = $(this).val();
    var s = str.search("<script>");
    var e = str.search("</script>");

    if (s > -1 || e > -1) {
        $(this).val("")
    }

});
$('.is_free').on('change', function () {
    // var i = $(this).prev('label').clone();
    var val = $(this).find(":selected").val();

    if (val == 1) {
        $('.is_free_div').hide()
    } else {
        if ($(".is_free_div").hasClass('d-none')) {
            $(".is_free_div").removeClass('d-none');
        }
        $('.is_free_div').show()

    }

    // return true
});
$("div").find(`[data-purpose='form-control-counter']`).prev('input').on('keyup', function () {

    const th = $(this);
    const il = th.val().length;
    const ml = th.attr('maxlength');
    const rm = ml - il;
    $(this).next('div').text(rm);
});

$(".invalid-feedback-lv").closest('.row').find('input').on('keyup', function () {

    let pd = $(this).parent();
    findFirstError(pd, 1)
});
$(".invalid-feedback-lv").closest('.row').find('select').on('change', function () {

    let pd = $(this).parent();
    findFirstError(pd, 1)
});

function findFirstError(pd, index) {

    if (index == 3) {
        return true;
    }
    pd = pd.parent();

    let err = pd.find(".invalid-feedback-lv")[0]

    if (err) {
        err.remove();
        return true;
    } else {
        index = index + 1

        findFirstError(pd, index)
    }
}


	$(document).on('keyup','.catsearch .srch_explore',function(){
		
		$.ajax({
			url:'/categories',
			type: "post",
			data:$(this).closest('form').serialize(),
			dataType:'json',
			success:function(d){
				$('.categorybox').html('');
				if(d.data)
					$.each(d.data,function(i,v){
						$('.categorybox').append('<a href="'+v.url+'" class="item" style="background-image:url('+v.image+'); background-size:cover;"><span>'+v.title+'</span></a>');
					})
				
			}
		});
	});

 setInterval(() => {
        checkMessage()
    }, 15000);
	
function checkMessage()
{
	if($('.option_links').length)
	{
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: '/messages/ajaxcheck',
			type: "POST",
			data: {},
			async: false,
			success: function (response, textStatus, jqXHR) {
				$('.dropdown_ms').html('');
				$('.messcnt .noti_count').remove();
				if(response.count)
				{
					if(response.count>0)
					{
						if($('.messcnt .noti_count').length)
							$('.messcnt .noti_count').text(response.count);
						else
							$('.messcnt').append('<span class="noti_count ">'+response.count+'</span>');
					}
					if(response.msg)
					{
						$.each(response.msg,function(i,v){
							$('.dropdown_ms').append('<a href="/author/messages/'+v.user_two+'" class="channel_my item">\
						<div class="profile_link">\
							<img src="'+v.userimage+'" alt="">\
							<div class="pd_content">\
								<h6>'+v.uname+'</h6>\
								<p>'+v.msg+'</p>\
								<span class="nm_time">'+v.dates+'</span>\
							</div>\
						</div>\
					</a>');
							
						})
					}
				}
			},
			error: function (jqXHR, textStatus, errorThrown) {

			}
		});
	}
}




function Copy(id) {
    var dummy = document.createElement('input'),
    text = window.location.href;
    document.body.appendChild(dummy);
    dummy.value = text;
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);
    

    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-start',
        showConfirmButton: false,
        timer: 2000,
        iconColor: '#03827D',
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });  
    Toast.fire({
        template: '#copyText'
    });
	
	$.ajax({
		url:'/ajax/copy/'+id,
		success:function(d){ $('#copyCnt'+id).text(d)}
	})
}


$(function () {
    $('[data-toggle="tooltip"]').tooltip();
// отмена для ссылок с атрибутом data-trigger="click" стандартного поведения
$('[data-trigger="manual"]').click(function(e) {
    e.preventDefault();
  });
  $('[data-trigger="manual"]').hover(function(e) {
    const target = $(e.target);
    target.tooltip('show');
    const id = target.attr('aria-describedby');
    $('#' + id).one('mouseleave', function(e) {
      target.tooltip('hide');
    });
    });
});