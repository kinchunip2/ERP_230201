"use strict";
// metisMenu
var metismenu = $("#sidebar_menu");
if (metismenu.length) {
    metismenu.metisMenu();
}

$(".open_miniSide").on('click', function() {
    $(".sidebar").toggleClass("mini_sidebar");
    $("#main-content").toggleClass("mini_main_content");
});


$(document).on('click', function(event) {
    if (!$(event.target).closest(".sidebar,.sidebar_icon  ").length) {
        $("body").find(".sidebar").removeClass("active");
    }
});

function slideToggle(clickBtn, toggleDiv) {
    clickBtn.on('click', function() {
        toggleDiv.stop().slideToggle('slow');
    });
}


$(function() {
    "use strict";
    $('#theme_nav li label').on('click', function() {
		$('#'+$(this).data('id')).show().siblings('div.Settings_option').hide();
    });
    $('#sms_setting li label').on('click', function() {
		$('#'+$(this).data('id')).show().siblings('div.sms_ption').hide();
    });
});



/*-------------------------------------------------------------------------------
        Start Upload file and chane placeholder name
    -------------------------------------------------------------------------------*/
var fileInput = document.getElementById('browseFile');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderInput').placeholder = fileName;
    }
}

if ($('.multipleSelect').length) {
    $('.multipleSelect').fastselect();
}

/*-------------------------------------------------------------------------------
        End Upload file and chane placeholder name
    -------------------------------------------------------------------------------*/

/*-------------------------------------------------------------------------------
        Start Check Input is empty
    -------------------------------------------------------------------------------*/
$('.input-effect input').each(function() {
    if ($(this).val().length > 0) {
        $(this).addClass('read-only-input');
    } else {
        $(this).removeClass('read-only-input');
    }

    $(this).on('keyup', function() {
        if ($(this).val().length > 0) {
            $(this).siblings('.invalid-feedback').fadeOut('slow');
        } else {
            $(this).siblings('.invalid-feedback').fadeIn('slow');
        }
    });
});

$('.input-effect textarea').each(function() {
    if ($(this).val().length > 0) {
        $(this).addClass('read-only-input');
    } else {
        $(this).removeClass('read-only-input');
    }
});

/*-------------------------------------------------------------------------------
        End Check Input is empty
    -------------------------------------------------------------------------------*/
$(window).on('load', function() {
    $('.input-effect input, .input-effect textarea').focusout(function() {
        if ($(this).val() != '') {
            $(this).addClass('has-content');
        } else {
            $(this).removeClass('has-content');
        }
    });
});

$('.primary-btn').on('click', function(e) {
    // Remove any old one
    $('.ripple').remove();

    // Setup
    var primaryBtnPosX = $(this).offset().left,
        primaryBtnPosY = $(this).offset().top,
        primaryBtnWidth = $(this).width(),
        primaryBtnHeight = $(this).height();

    // Add the element
    $(this).prepend("<span class='ripple'></span>");

    // Make it round!
    if (primaryBtnWidth >= primaryBtnHeight) {
        primaryBtnHeight = primaryBtnWidth;
    } else {
        primaryBtnWidth = primaryBtnHeight;
    }

    // Get the center of the element
    var x = e.pageX - primaryBtnPosX - primaryBtnWidth / 2;
    var y = e.pageY - primaryBtnPosY - primaryBtnHeight / 2;

    // Add the ripples CSS and start the animation
    $('.ripple')
        .css({
            width: primaryBtnWidth,
            height: primaryBtnHeight,
            top: y + 'px',
            left: x + 'px'
        })
        .addClass('rippleEffect');
});

$('.pm_project__icon button').on('click', function () {
    $('.project_color_dropdown').toggleClass('color_dropdown_open');
});

// profile js
$(".fass_form_toggler").on('click', function() {
    $(this).parent('.password_wrap_inner').hide();
    $(".fass_form").slideDown();
});
$(".fass_form_close").on('click', function() {
    $(".fass_form").slideUp();
    $('.password_wrap_inner').show();
});

