"use strict";

const APP_URL = $('meta[name="url"]').attr('content');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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
            oastr.error(trans('js.Something is not right'), trans('js.Error'))
        }
    });
});

if ((window.location.hash && window.location.hash === "#_=_")) {
    // If you are not using Modernizr, then the alternative is:
    if (window.history && history.replaceState) {
        window.history.replaceState("", document.title, window.location.pathname);
    } else {
        // Prevent scrolling by storing the page's current scroll offset
        var scroll = {
            top: document.body.scrollTop,
            left: document.body.scrollLeft
        };
        window.location.hash = "";
        // Restore the scroll offset, should be flicker free
        document.body.scrollTop = scroll.top;
        document.body.scrollLeft = scroll.left;
    }
}

if ($('.datatable').length > 0 && $().DataTable) {
    $.extend(true, $.fn.dataTable.defaults, {
        bLengthChange: false,
        "order": [
            [0, "desc"]
        ],
        language: {
            search: "<i class='ti-search'></i>",
            searchPlaceholder: trans('js.Quick Search'),
            lengthMenu: trans('js.Show')+" _MENU_ " + trans('js.entries'),
            zeroRecords: trans('js.No data available in table'),
            info: trans('js.Showing page')+" _PAGE_ "+trans('js.of')+" _PAGES_",
            infoEmpty: trans('js.No records available'),
            infoFiltered: "( "+ trans('js.filtered from')+" _MAX_ "+trans('js.total records')+")",
            paginate: {
                next: "<i class='ti-arrow-right'></i>",
                previous: "<i class='ti-arrow-left'></i>"
            }
        },
        dom: 'Bfrtip',
        buttons: [{
                extend: 'copyHtml5',
                text: '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy',
                exportOptions: {
                    columns: ':visible',
                    columns: ':not(:last-child)',
                }
            },
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
                margin: [10, 10, 10, 0],
                exportOptions: {
                    columns: ':visible',
                    columns: ':not(:last-child)',
                },

            },
            {
                extend: 'csvHtml5',
                text: '<i class="fa fa-file-text"></i>',
                titleAttr: 'CSV',
                exportOptions: {
                    columns: ':visible',
                    columns: ':not(:last-child)',
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF',
                exportOptions: {
                    columns: ':visible',
                    columns: ':not(:last-child)',
                },
                orientation: 'landscape',
                pageSize: 'A4',
                margin: [0, 0, 0, 12],
                alignment: 'center',
                header: true,
                customize: function(doc) {
                    doc.content.splice(1, 0, {
                        margin: [0, 0, 0, 12],
                        alignment: 'center',
                        image: 'data:image/png;base64,' + $("#logo_img").val()
                    });
                }

            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i>',
                titleAttr: 'Print',
                exportOptions: {
                    columns: ':not(:last-child)',
                }
            },
            {
                extend: 'colvis',
                text: '<i class="fa fa-columns"></i>',
                postfixButtons: ['colvisRestore']
            }
        ],
        columnDefs: [{
            visible: false
        }],
        responsive: true,
        columnDefs: [{
            orderable: false,
            searchable: false,
            width: '100px',
            targets: -1
        }, {
            width: '30px',
            targets: 0
        }]
    });
}


$('.bs-popover').popover();


if($('.primary_select').length){
    $('.primary_select').niceSelect();
}


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
            toastr.success(data.message, 'Success');
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
