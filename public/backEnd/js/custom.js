"use strict";

$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $('[data-toggle="tooltip"]').tooltip();
});


$(document).ready(function () {
    $(document).on('click', '.show_due', function () {
        if ($(this).prop('checked') == true)
        {
            $('.previous_due').show();
            $('.total_due').show();
        }
        else
        {
            $('.previous_due').hide();
            $('.total_due').hide();
        }
    })
    $('.isDisabled').click(function (e) {
        e.preventDefault();
    });

    $('#all_sections').change(function () {
        $('.section-checkbox').prop('checked', this.checked);
    });

    $('.section-checkbox').change(function () {
        if ($('.section-checkbox:checked').length == $('.section-checkbox').length) {
            $('#all_sections').prop('checked', true);
        } else {
            $('#all_sections').prop('checked', false);
        }
    });
});

// image or file browse
var fileInput = document.getElementById('photo');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        'use strict';
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderPhoto').placeholder = fileName;
    }
}

var fileInput = document.getElementById('document_file_1');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderFileOneName').placeholder = fileName;
    }
}

var fileInput = document.getElementById('document_file_2');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        'use strict';
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderFileTwoName').placeholder = fileName;
    }
}

var fileInput = document.getElementById('document_file_3');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        'use strict';
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderFileThreeName').placeholder = fileName;
    }
}

var fileInput = document.getElementById('document_file_4');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        'use strict';
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderFileFourName').placeholder = fileName;
    }
}



// staff photo upload js
var fileInput = document.getElementById('staff_photo');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        'use strict';
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderStaffsFName').placeholder = fileName;
    }
}

// Fees Assign
$('#checkAll').on('click', function () {
    $('input:checkbox').prop('checked', this.checked);
});

$('input:checkbox').on('click', function () {
    if (!$(this).is(':checked')) {
        $('#checkAll').prop('checked', false);
    }
    var numberOfChecked = $('input:checkbox:checked').length;
    var totalCheckboxes = $('input:checkbox').length;
    var totalCheckboxes = totalCheckboxes - 1;

    if (numberOfChecked == totalCheckboxes) {
        $('#checkAll').prop('checked', true);
    }
});



// for project

const APP_URL = $('meta[name="url"]').attr('content');

$(document).on('click', '.btn-modal', function(e) {
    e.preventDefault();
    let container = '.' + $(this).data('container');
    $.ajax({
        url: $(this).data('href'),
        dataType: 'html',
        success: function(result) {
            $(container)
                .html(result)
                .modal('show');

            $(container).on('shown.bs.modal', function() {
                $('input:text:visible:first', this).focus();
            })
        },
        error: function(data) {
            toastr.error('Something is not right!', 'Opps!');
        }
    });
});




$(document).on('click', '#logout', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        url: url,
        method: 'Post',
        contentType: false, // The content type used when sending data to the server.
        cache: false, // To unable request pages to be cached
        processData: false,
        dataType: 'JSON',
        success: function(data) {
            toastr.success(data.message, trans('js.Success'));
            setTimeout(function() {
                window.location.href = data.goto;
            }, 2000);
        },
        error: function(data) {
            ajax_error(data);
        }
    });
});

$(document).on('keypress', 'input.input_number', function(event) {
    if (is_decimal == 0) {
        if (__currency_decimal_separator == '.') {
            var regex = new RegExp(/^[0-9,-]+$/);
        } else {
            var regex = new RegExp(/^[0-9.-]+$/);
        }
    } else {
        var regex = new RegExp(/^[0-9.,-]+$/);
    }

    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});





if ($('.date').length > 0 && $().datepicker) {
    $('.date').datepicker({
        Default: {
            leftArrow: '<i class="fa fa-long-arrow-left"></i>',
            rightArrow: '<i class="fa fa-long-arrow-right"></i>'
        },
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        language: LANG,
        rtl : RTL
    });

    $(document).on('click', '.date-icon', function() {
        $(this).parent().parent().find('.date').focus();
    });

    $(document).on('click', '.add_month', function() {
        let month = $(this).data('month');
        let new_date = moment().add(month, 'months').format("YYYY-MM-DD");

        $(this).parent().parent().parent().find('.date').val(new_date).datepicker('update');
    })
}

$(document).on('click', '.ajax_request', function (e){
    e.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        url: url,
        method: 'GET',
        dataType: 'JSON',
        success: function(data) {
            toastr.success(data.message, trans('js.Success'));
            if(data.goto){
                setTimeout(function() {
                    window.location.href = data.goto;
                }, 2000);
            }
            if (data.reload){
                setTimeout(function() {
                    window.location.href = '';
                }, 2000);
            }

        },
        error: function(data) {
            ajax_error(data);
        }
    });

})


//on click show description box
$(document).on('click', 'label[for="description"]', function (){
    $(this).removeClass('click_to_show_description');
    $(this).parent().find('textarea').removeClass('sr-only');
})


// for project

function ajax_error(data) {
    if (data.status === 404) {
        toastr.error(trans('js.What you are looking is not found'), trans('js.Opps'));
        return;
    } else if (data.status === 500) {
        toastr.error(trans('js.Something went wrong. If you are seeing this message multiple times, please contact Spondon IT authors.'), trans('js.Opps'));
        return;
    } else if (data.status === 200) {
        toastr.error(trans('js.Something is not right'), trans('js.Error'));
        return;
    }
    let jsonValue = $.parseJSON(data.responseText);
    let errors = jsonValue.errors;
    if (errors) {
        let i = 0;
        $.each(errors, function(key, value) {
            let first_item = Object.keys(errors)[i];
            let error_el_id = $('#' + first_item);
            if (error_el_id.length > 0) {
                error_el_id.parsley().addError('ajax', {
                    message: value,
                    updateClass: true
                });
            }
            toastr.error(value, trans('js.Validation Error'));
            i++;
        });
    } else {
        toastr.error(jsonValue.message, trans('js.Opps'));
    }
}

function jsUcfirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}


function _formValidation(form_id = 'content_form', modal = false, modal_id = 'content_modal', ajax_table = null) {

    const form = $('#' + form_id);

    if (!form.length) {
        return;
    }

    form.parsley().on('field:validated', function() {
        $('.parsley-ajax').remove();
        const ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
    });
    form.on('submit', function(e) {
        e.preventDefault();
        $('.parsley-ajax').remove();
        form.find('.submit').hide();
        form.find('.submitting').show();
        const submit_url = form.attr('action');
        const method = form.attr('method');
        //Start Ajax
        const formData = new FormData(form[0]);
        $.ajax({
            url: submit_url,
            type: method,
            data: formData,
            contentType: false, // The content type used when sending data to the server.
            cache: false, // To unable request pages to be cached
            processData: false,
            dataType: 'JSON',
            success: function(data) {
                toastr.success(data.message, trans('js.Success'));
                if (modal) {
                    $("." + modal_id).modal('hide');
                }
                if (ajax_table) {
                    ajax_table.ajax.reload();
                }

                if (data.goto) {
                    window.location.href = data.goto;
                }

                if (data.reload) {
                    window.location.href = '';
                }

                form.find('.submit').show();
                form.find('.submitting').hide();

            },
            error: function(data) {
                ajax_error(data);
                let method = $('input[name="_method"]').val();
                if (method.toLowerCase() == 'delete' && modal){
                    $("." + modal_id).modal('hide');
                }
                form.find('.submit').show();
                form.find('.submitting').hide();
            }
        });
    });
}



function convertNumber(number) {
    number = parseFloat(number);
    if (isNaN(number)) {
        return 0;
    }

    return number;
}
function imageChangeWithFile(input, srcId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(srcId)
                .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
function _componentAjaxChildLoad(form_id = '#content_form', parent_id = '#country_id', child_id = '#state_id', module='state') {

    $(document).on('change', parent_id, function(e) {
        var content_id = form_id + ' ' + child_id;
        var value = $(this).val();
        $(content_id + '>option').remove();
        var child = $(form_id + ' select' + child_id);
        child.append(
            $('<option>', {
                value: '',
                text: trans('js.Select '+ ucword(module))
            })
        );
        $.ajax({
            url: $('#app_base_url').val() + '/select/'+module,
            type: 'post',
            data: {
                value: value
            },
            dataType: 'json'
        })
            .done(function(data) {
                $.each(data, function(i, v) {
                    child.append(
                        $('<option>', {
                            value: v.id,
                            text: v.name
                        })
                    );
                })
                child.trigger('change');
                child.niceSelect('update');
            })
            .fail(function(data) {
                toastr.error(trans('js.Something is not right'), trans('js.Error'))
            });
    });
};

function ucword(value){
    "use strict";
    if(!value)
        return;

    return value.toLowerCase().replace(/\b[a-z]/g, function(value) {
        return value.toUpperCase();
    });
}
