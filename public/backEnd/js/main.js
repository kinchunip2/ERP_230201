(function ($) {
    'use strict';

    // metisMenu
    var metismenu = $("#sidebar_menu");
    if (metismenu.length) {
        metismenu.metisMenu();
    }

    $(".open_miniSide").click(function () {
        $(".sidebar").toggleClass("mini_sidebar");
        $("#main-content").toggleClass("mini_main_content");
    });


    $(document).click(function (event) {
        if (!$(event.target).closest(".sidebar,.sidebar_icon  ").length) {
            $("body").find(".sidebar").removeClass("active");
        }
    });

    function slideToggle(clickBtn, toggleDiv) {
        'use strict';
        clickBtn.on('click', function () {
            toggleDiv.stop().slideToggle('slow');
        });
    }

    $(document).ready(function () {
        $(".Earning_add_btn").click(function () {
            $(".single_earning_value").append(`<div class="row">
			<div class="col-lg-7">
				<div class="primary_input mb-25">
					<label class="primary_input_label" for="">Type</label>
					<input class="primary_input_field" placeholder="-" type="text">
				</div>
			</div>
			<div class="col-lg-5">
				<div class="primary_input mb-25">
					<label class="primary_input_label" for="">Value</label>
					<input class="primary_input_field" placeholder="-" type="text">
				</div>
			</div>
		</div>`);
        });
    });
    $(document).ready(function () {
        $(".deductions_add_btn").click(function () {
            $(".single_deductions_value").append(`<div class="row">
			<div class="col-lg-7">
				<div class="primary_input mb-25">
					<label class="primary_input_label" for="">Type</label>
					<input class="primary_input_field" placeholder="-" type="text">
				</div>
			</div>
			<div class="col-lg-5">
				<div class="primary_input mb-25">
					<label class="primary_input_label" for="">Value</label>
					<input class="primary_input_field" placeholder="-" type="text">
				</div>
			</div>
		</div>`);
        });
    });

    function removeDiv(clickBtn, toggleDiv) {
        clickBtn.on('click', function () {
            toggleDiv.hide('slow', function () {
                toggleDiv.remove();
            });
        });
    }

    slideToggle($('#barChartBtn'), $('#barChartDiv'));
    removeDiv($('#barChartBtnRemovetn'), $('#incomeExpenseDiv'));
    slideToggle($('#areaChartBtn'), $('#areaChartDiv'));
    removeDiv($('#areaChartBtnRemovetn'), $('#incomeExpenseSessionDiv'));

    /*-------------------------------------------------------------------------------
         Start Primary Button Ripple Effect
       -------------------------------------------------------------------------------*/
    $('.primary-btn').on('click', function (e) {
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

    // for form popup
    $('.pop_up_form_hader').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $('.pop_up_form_hader.active').removeClass('active');
            $(this).addClass('active');
        }
    });
    $(document).click(function (event) {
        if (!$(event.target).closest(".company_form_popup").length) {
            $("body").find(".pop_up_form_hader").removeClass("active");
        }
    });
    jQuery(document).ready(function ($) {
        $('.small_circle_1').circleProgress({
            value: 0.75,
            size: 60,
            lineCap: 'round',
            emptyFill: getCssColor('text_white'),
            thickness: '5',
            fill: {
                gradient: [[getCssColor('gradient_1'), .47], [getCssColor('gradient_3'), .3]]
            }
        });
    });
    jQuery(document).ready(function ($) {
        $('.large_circle').circleProgress({
            value: 0.75,
            size: 228,
            lineCap: 'round',
            emptyFill: getCssColor('text_white'),
            thickness: '5',
            fill: {
                gradient: [[getCssColor('gradient_1'), .47], [getCssColor('gradient_3'), .3]]
            }
        });
    });

    jQuery(document).ready(function ($) {
        $(".entry-content").hide('slow');
        $(".entry-title").on('click', function () {
            $(".entry-content").hide();
            $(this).parent().children(".entry-content").slideToggle(600);
        });
    });

    $(document).ready(function () {
        // sumer note
        $('#summernote').summernote({
            placeholder: 'Write down here',
            tabsize: 2,
            height: 360,
            tooltip: false
        });
        // sumer note
        $('#summernote2').summernote({
            placeholder: 'Write down here',
            tabsize: 2,
            height: 175,
            tooltip: false
        });
        // sumer note
        $('.summernote3').summernote({
            placeholder: '',
            tabsize: 2,
            height: 250,
            tooltip: false
        });
        // sumer note
        $('.summernote5').summernote({
            placeholder: 'Add your Comment',
            tabsize: 2,
            height: 120,
            tooltip: false
        });

        $(document).ready(function () {
            $('.summernote').summernote({
                height: 400,
                tabsize: 2,
                tooltip: false,
                codeviewFilter: true,
                codeviewIframeFilter: true,
                toolbar: [
                    [ 'style', [ 'style' ] ],
                    [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                    [ 'fontname', [ 'fontname' ] ],
                    [ 'fontsize', [ 'fontsize' ] ],
                    [ 'color', [ 'color' ] ],
                    [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                    [ 'table', [ 'table' ] ],
                    [ 'insert', [ 'link'] ],
                    [ 'view', [ 'undo', 'redo', 'fullscreen', 'help' ] ]
                ]
            });
        })


    })

    /*-------------------------------------------------------------------------------
         Start Add Deductions
       -------------------------------------------------------------------------------*/
    $('#addDeductions').on('click', function () {
        $('#addDeductionsTableBody').append(
            '<tr>' +
            '<td width="80%" class="pr-30 pt-20">' +
            '<div class="input-effect mt-10">' +
            '<input class="primary-input form-control" type="text" id="searchByFileName">' +
            '<label for="searchByFileName">Type</label>' +
            '<span class="focus-border"></span>' +
            '</div>' +
            '</td>' +
            '<td width="20%" class="pt-20">' +
            '<div class="input-effect mt-10">' +
            '<input class="primary-input form-control" type="text" id="searchByFileName">' +
            '<label for="searchByFileName">Value</label>' +
            '<span class="focus-border"></span>' +
            '</div>' +
            '</td>' +
            '<td width="10%" class="pt-30">' +
            '<button class="primary-btn icon-only fix-gr-bg close-deductions">' +
            '<span class="ti-close"></span>' +
            '</button>' +
            '</td>' +
            '</tr>'
        );
    });

    $('#addDeductionsTableBody').on('click', '.close-deductions', function () {
        $(this).closest('tr').fadeOut(500, function () {
            $(this).closest('tr').remove();
        });
    });


    /*-------------------------------------------------------------------------------
         Start Upload file and chane placeholder name
       -------------------------------------------------------------------------------*/
    var fileInput = document.getElementById('browseFile');
    if (fileInput) {
        fileInput.addEventListener('change', showFileName);

        function showFileName(event) {
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
    $('.input-effect input').each(function () {
        if ($(this).val().length > 0) {
            $(this).addClass('read-only-input');
        } else {
            $(this).removeClass('read-only-input');
        }

        $(this).on('keyup', function () {
            if ($(this).val().length > 0) {
                $(this).siblings('.invalid-feedback').fadeOut('slow');
            } else {
                $(this).siblings('.invalid-feedback').fadeIn('slow');
            }
        });
    });

    $('.input-effect textarea').each(function () {
        if ($(this).val().length > 0) {
            $(this).addClass('read-only-input');
        } else {
            $(this).removeClass('read-only-input');
        }
    });

    /*-------------------------------------------------------------------------------
         End Check Input is empty
       -------------------------------------------------------------------------------*/
    $(window).on('load', function () {
        $('.input-effect input, .input-effect textarea').focusout(function () {
            if ($(this).val() != '') {
                $(this).addClass('has-content');
            } else {
                $(this).removeClass('has-content');
            }
        });
    });

    /*-------------------------------------------------------------------------------
         End Input Field Effect
       -------------------------------------------------------------------------------*/
    // Search icon

    $('#search-icon').on('click', function () {
        $('#search').focus();
    });

    $('#start-date-icon').on('click', function () {
        $('#startDate').focus();

    });

    $('#end-date-icon').on('click', function () {
        $('#endDate').focus();
    });
    $('.primary-input.date').datepicker({
        autoclose: true,
        setDate: new Date(),
        rtl : RTL,
        language: LANG
    });
    $('.primary-input.format_date').datepicker({
        autoclose: true,
        setDate: new Date(),
        rtl : RTL,
        language: LANG
    });
    $('.primary-input.format_date').on('changeDate', function (ev) {
        $(this).focus();
    });
    $('.primary-input.date').on('changeDate', function (ev) {
        $(this).focus();
    });

    $('.primary-input.time').datetimepicker({
        format: 'LT'
    });

    $('#startDate').datepicker({
        Default: {
            leftArrow: '<i class="fa fa-long-arrow-left"></i>',
            rightArrow: '<i class="fa fa-long-arrow-right"></i>'
        },
        rtl : RTL,
        language: LANG
    });
    /*-------------------------------------------------------------------------------
         Start Side Nav Active Class Js
       -------------------------------------------------------------------------------*/
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
    $('#close_sidebar').on('click', function () {
        $('#sidebar').removeClass('active');
    })


    // setNavigation();
    /*-------------------------------------------------------------------------------
         Start Side Nav Active Class Js
       -------------------------------------------------------------------------------*/
    $(window).on('load', function () {

        $('.dataTables_wrapper .dataTables_filter input').on('focus', function () {
            $('.dataTables_filter > label').addClass('jquery-search-label');
        });

        $('.dataTables_wrapper .dataTables_filter input').on('blur', function () {
            $('.dataTables_filter > label').removeClass('jquery-search-label');
        });
    });


    $('.single-cms-box .btn').on('click', function () {
        $(this).fadeOut(500, function () {
            $(this).closest('.col-lg-2.mb-30').hide();
        });
    });

    /*----------------------------------------------------*/
    /*  Magnific Pop up js (Image Gallery)
    /*----------------------------------------------------*/
    $('.pop-up-image').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    /*-------------------------------------------------------------------------------
         Nice Select
       -------------------------------------------------------------------------------*/
    if ($('.niceSelect').length) {
        $('.niceSelect').niceSelect();
    }
    //niceselect select jquery
    $('.nice_Select').niceSelect();
    //niceselect select jquery
    $('.nice_Select2').niceSelect();
    $('.primary_select').niceSelect();



    // for crm marge field update
    $('.marge_field_open').on('click', function () {
        $('.tab_marge_wrap').toggleClass('tab_marge_wrap_active');
    });

    $(document).on('click', function (event) {
        if (!$(event.target).closest(".marge_field_open ,.tab_marge_wrap").length) {
            $("body").find(".tab_marge_wrap").removeClass("tab_marge_wrap_active");
        }
    });

    // for MENU POPUP
    $('.popUP_clicker').on('click', function () {
        $('.menu_popUp_list_wrapper').toggleClass('active');
    });

    $(document).on('click', function (event) {
        if (!$(event.target).closest(".popUP_clicker ,.menu_popUp_list_wrapper").length) {
            $("body").find(".menu_popUp_list_wrapper").removeClass("active");
        }
    });

    // for MENU notification
    $('.bell_notification_clicker').on('click', function () {
        $('.Menu_NOtification_Wrap').toggleClass('active');
    });

    $(document).on('click', function (event) {
        if (!$(event.target).closest(".bell_notification_clicker ,.Menu_NOtification_Wrap").length) {
            $("body").find(".Menu_NOtification_Wrap").removeClass("active");
        }
    });

    // OPEN CUSTOMERS POPUP
    $('.pop_up_form_hader').on('click', function () {
        $('.company_form_popup').toggleClass('Company_Info_active');
        $('.pop_up_form_hader').toggleClass('Company_Info_opened');
    });

    $(document).on('click', function (event) {
        if (!$(event.target).closest(".pop_up_form_hader ,.company_form_popup").length) {
            $("body").find(".company_form_popup").removeClass("Company_Info_active");
            $("body").find(".pop_up_form_hader").removeClass("Company_Info_opened");
        }
    });


    // CHAT_MENU_OPEN
    $('.CHATBOX_open').on('click', function () {
        $('.CHAT_MESSAGE_POPUPBOX').toggleClass('active');
    });
    $('.MSEESAGE_CHATBOX_CLOSE').on('click', function () {
        $('.CHAT_MESSAGE_POPUPBOX').removeClass('active');
    });

    $(document).on('click', function (event) {
        if (!$(event.target).closest(".CHAT_MESSAGE_POPUPBOX, .CHATBOX_open").length) {
            $("body").find(".CHAT_MESSAGE_POPUPBOX").removeClass("active");
        }
    });


    // add_action
    $('.add_action').on('click', function () {
        $('.quick_add_wrapper').toggleClass('active');
    });
    $(document).on('click', function (event) {
        if (!$(event.target).closest(".quick_add_wrapper, .add_action").length) {
            $("body").find(".quick_add_wrapper").removeClass("active");
        }
    });


    // filter_text
    $('.filter_text span').on('click', function () {
        $('.filterActivaty_wrapper').toggleClass('active');
    });
    $(document).click(function (event) {
        if (!$(event.target).closest(".filterActivaty_wrapper , .filter_text span").length) {
            $("body").find(".filterActivaty_wrapper").removeClass("active");
        }
    });


    //active courses option
    $(".leads_option_open").on("click", function () {
        $(this).parent(".dots_lines").toggleClass("leads_option_active");
    });
    $(document).on('click', function (event) {
        if (!$(event.target).closest(".dots_lines").length) {
            $("body")
                .find(".dots_lines")
                .removeClass("leads_option_active");
        }
    });
// ######  inbox style icon ######
    $('.favourite_icon i').on('click', function (e) {
        $(this).toggleClass("selected_favourite"); //you can list several class names
        e.preventDefault();
    });


// ######  copyTask style #######
    $(".CopyTask_clicker").on("click", function () {
        $(this).parent("li.copy_task").toggleClass("task_expand_wrapper_open");
    });
    $(document).on('click', function (event) {
        if (!$(event.target).closest("li.copy_task").length) {
            $("body")
                .find("li.copy_task")
                .removeClass("task_expand_wrapper_open");
        }
    });

// ######  copyTask style #######
    $(".Reminder_clicker").on("click", function () {
        $(this).parent("li.Set_Reminder").toggleClass("task_expand_wrapper_open");
    });
    $(document).on('click', function (event) {
        if (!$(event.target).closest("li.Set_Reminder").length) {
            $("body")
                .find("li.Set_Reminder")
                .removeClass("task_expand_wrapper_open");
        }
    });

// Crm_table_active
    if ($('.Crm_table_active').length) {
        $('.Crm_table_active').DataTable({
            drawCallback: function () {
                $('.dt-select2').select();
            },
            bLengthChange: false,
            stateSave: true,
            "bDestroy": true,
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
            columnDefs: [{
                visible: false
            }],
            responsive: true,
            searching: false,
        });
    }

// Crm_table_active 2
    if ($('.Crm_table_active2').length) {
        $('.Crm_table_active2').DataTable({
            bLengthChange: false,
            "bDestroy": false,
            stateSave: true,
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
            columnDefs: [{
                visible: false
            }],
            responsive: true,
            searching: false,
            paging: false,
            info: false
        });
    }

    $(document).ready(function () {
        // CRM TABLE 3
        if ($('.Crm_table_active3').length) {
            pdfMake.fonts = {
                DejaVuSans: {
                    normal: 'DejaVuSans.ttf',
                    bold: 'DejaVuSans-Bold.ttf',
                    italics: 'DejaVuSans-Oblique.ttf',
                    bolditalics: 'DejaVuSans-BoldOblique.ttf'
                }
            };
            $('.Crm_table_active3').DataTable({
                bLengthChange: true,
                "bDestroy": true,
                stateSave: true,
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
                dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-files-o"></i>',
                        title: $("#logo_title").val(),
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
                        title: $("#logo_title").val(),
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
                        title: $("#logo_title").val(),
                        titleAttr: 'PDF',
                        charSet: 'utf-8',

                        exportOptions: {
                            columns: ':visible',
                            columns: ':not(:last-child)',
                        },
                        orientation: 'landscape',
                        pageSize: 'A4',
                        margin: [0, 0, 0, 0],
                        alignment: 'center',
                        header: true,
                        customize: function (doc) {

                            doc.content[1].table.widths =
                                Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.content.splice(1, 0, {
                                margin: [0, 0, 0, 0],
                                alignment: 'center',
                                image: 'data:image/png;base64,' + $("#logo_img").val(),
                            });
                            doc.defaultStyle = {
                                font: 'DejaVuSans'
                            }
                        }

                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: 'Print',
                        alignment: 'center',
                        title: $("#logo_title").val(),
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
            });
        }



    });


// CRM TABLE 4
    if ($('.Crm_table_active4').length) {
        $('.Crm_table_active4').DataTable({
            bLengthChange: false,
            "bDestroy": false,
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
            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'copyHtml5',
                    text: '<i class="fa fa-files-o"></i>',
                    title: $("#logo_title").val(),
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
                    title: $("#logo_title").val(),
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
                    title: $("#logo_title").val(),
                    titleAttr: 'PDF',
                    exportOptions: {
                        columns: ':visible',
                        columns: ':not(:last-child)',
                    },
                    orientation: 'landscape',
                    pageSize: 'A4',
                    margin: [0, 0, 0, 0],
                    alignment: 'center',
                    header: true,
                    customize: function (doc) {
                        doc.content[1].table.widths =
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        doc.content.splice(1, 0, {
                            margin: [0, 0, 0, 0],
                            alignment: 'center',
                            image: 'data:image/png;base64,' + $("#logo_img").val()
                        });
                    }

                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i>',
                    titleAttr: 'Print',
                    alignment: 'center',
                    title: $("#logo_title").val(),
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
            },
                {
                    orderable: false,
                    width: '50px',
                    targets: 0
                },],
            responsive: true,
        });
    }

// TABS DATA TABLE ISSU

    $(document).ready(function () {
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust()
                .responsive.recalc();
        });
    });


    $(document).ready(function () {
        $(document).ready(function () {
            $(".Add_note").click(function () {
                $(".note_add_form").slideToggle(900);
            });
        });
    });


    $(document).on('click', '.remove', function () {
        $(this).parents('.row_lists').fadeOut();
    });
    $(document).ready(function () {
        $('.add_single_row').click(function () {
            $('.row_lists').parent("tbody").prepend('<tr class="row_lists"> <td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"></td><td class="pl-0 pb-0" style="border:0"> <textarea class="placeholder_invoice_textarea" placeholder="-" ></textarea> </td><td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"> </td><td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"></td><td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"></td><td class="pl-0 pb-0" style="border:0"><input class="placeholder_input" placeholder="-" type="text"> </td><td class="pl-0 pb-0 pr-0 remove" style="border:0"> <div class="items_min_icon "><i class="fas fa-minus-circle"></i></div></td></tr>');
        });
    })
// nestable for drah and drop
    $(document).ready(function () {
        $('#nestable').nestable({
            group: 1
        })

    });

// METU SET UP
    $(".edit_icon").on("click", function (e) {
        var target = $(this).parent().find('.menu_edit_field');
        $(this).toggleClass("expanded");
        target.slideToggle();
        $('.menu_edit_field').not(target).slideUp();
    });

// SCROLL NAVIGATION
    $(document).ready(function () {
        // scroll /
        $('.scroll-left-button').click(function () {
            event.preventDefault();
            $('.scrollable_tablist').animate({
                scrollLeft: "+=300px"
            }, "slow");
        });

        $('.scroll-right-button ').click(function () {
            event.preventDefault();
            $('.scrollable_tablist').animate({
                scrollLeft: "-=300px"
            }, "slow");
        });
    });


})(jQuery);


function setNavigation() {
    'use strict';
    var current = location.href;

    var url = document.getElementById('url').value;
    var previousUrl = document.referrer;

    var i = 0;

    $('#sidebar ul li ul li a').each(function () {
        var $this = $(this);
        // if the current path is like this link, make it active
        if ($this.attr('href') == current) {
            i++;
            $this.closest('.list-unstyled').addClass('show');
            $this.closest('.list-unstyled').siblings('.dropdown-toggle').addClass('active');
            $this.addClass('active');
        }
    });

    if (current == url + '/' + 'admin-dashboard') {

        i++;

        $('#admin-dashboard').addClass('active');
    }

    if (i == 0) {
        $('#sidebar ul li ul li a').each(function () {
            var $this = $(this);
            // if the current path is like this link, make it active
            if ($this.attr('href') == previousUrl) {
                i++;
                $this.closest('.list-unstyled').addClass('show');
                $this.closest('.list-unstyled').siblings('.dropdown-toggle').addClass('active');
                $this.addClass('active');
            }
        });
    }


    if (current == url + '/' + 'exam-attendance-create') {

        $('#subMenuExam').addClass('show');
        $('#subMenuExam').closest('.list-unstyled').siblings('.dropdown-toggle').addClass('active');
        $("#sidebar a[href='" + url + '/' + "exam-attendance']").addClass('active');
    }


}


$(document).ready(function (e) {
    $('.hide_row').on('click', function () {
        $(this).parent().parent().hide();
        return false;
    });
});

$(document).ready(function (e) {
    $('.minus_single_role').on('click', function () {
        $(this).parent(".single__role_member").hide(400);
        return false;
    });
});

// inc dec number
(function ($) {

    var cartButtons = $('.product_number_count').find('span');

    $(cartButtons).on('click', function (e) {

        e.preventDefault();
        var $this = $(this);
        var target = $this.parent().data('target');
        var target = $('#' + target);
        var current = parseFloat($(target).val());

        if ($this.hasClass('number_increment'))
            target.val(current + 1);
        else {
            (current < 1) ? null : target.val(current - 1);
        }
    });
}(jQuery));

$(function () {
    "use strict";
    $('#theme_nav li label').on('click', function () {
        $('#' + $(this).data('id')).show().siblings('div.Settings_option').hide();
    });
    $('#sms_setting li label').on('click', function () {
        $('#' + $(this).data('id')).show().siblings('div.sms_ption').hide();
    });
});

function getCssColor(color) {
    "use strict";
    return getComputedStyle(document.documentElement)
        .getPropertyValue('--' + color); // #999999
}
(function($){
    //pipeline DataTable
    $.fn.dataTable.pipeline = function ( opts ) {
        // Configuration options
        var conf = $.extend( {
            pages: 5,     // number of pages to cache
            url: '',      // script url
            data: null,   // function or object with parameters to send to the server
                          // matching how `ajax.data` works in DataTables
            method: 'GET' // Ajax HTTP method
        }, opts );

        // Private variables for storing the cache
        var cacheLower = -1;
        var cacheUpper = null;
        var cacheLastRequest = null;
        var cacheLastJson = null;

        return function ( request, drawCallback, settings ) {
            var ajax          = false;
            var requestStart  = request.start;
            var drawStart     = request.start;
            var requestLength = request.length;
            var requestEnd    = requestStart + requestLength;

            if ( settings.clearCache ) {
                // API requested that the cache be cleared
                ajax = true;
                settings.clearCache = false;
            }
            else if ( cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper ) {
                // outside cached data - need to make a request
                ajax = true;
            }
            else if ( JSON.stringify( request.order )   !== JSON.stringify( cacheLastRequest.order ) ||
                JSON.stringify( request.columns ) !== JSON.stringify( cacheLastRequest.columns ) ||
                JSON.stringify( request.search )  !== JSON.stringify( cacheLastRequest.search )
            ) {
                // properties changed (ordering, columns, searching)
                ajax = true;
            }

            // Store the request for checking next time around
            cacheLastRequest = $.extend( true, {}, request );

            if ( ajax ) {
                // Need data from the server
                if ( requestStart < cacheLower ) {
                    requestStart = requestStart - (requestLength*(conf.pages-1));

                    if ( requestStart < 0 ) {
                        requestStart = 0;
                    }
                }

                cacheLower = requestStart;
                cacheUpper = requestStart + (requestLength * conf.pages);

                request.start = requestStart;
                request.length = requestLength*conf.pages;

                // Provide the same `data` options as DataTables.
                if ( typeof conf.data === 'function' ) {
                    // As a function it is executed with the data object as an arg
                    // for manipulation. If an object is returned, it is used as the
                    // data object to submit
                    var d = conf.data( request );
                    if ( d ) {
                        $.extend( request, d );
                    }
                }
                else if ( $.isPlainObject( conf.data ) ) {
                    // As an object, the data given extends the default
                    $.extend( request, conf.data );
                }

                return $.ajax(
                    {
                        "type":     conf.method,
                        "url":      conf.url,
                        "data":     request,
                        "dataType": "json",
                        "cache":    false,
                        "success":  function ( json ) {
                            cacheLastJson = $.extend(true, {}, json);

                            if ( cacheLower != drawStart ) {
                                json.data.splice( 0, drawStart-cacheLower );
                            }
                            if ( requestLength >= -1 ) {
                                json.data.splice( requestLength, json.data.length );
                            }

                            drawCallback( json );
                        }
                    } );
            }
            else {
                var json = $.extend( true, {}, cacheLastJson );
                json.draw = request.draw; // Update the echo for each response
                json.data.splice( 0, requestStart-cacheLower );
                json.data.splice( requestLength, json.data.length );

                drawCallback(json);
            }
        }
    };
    // Register an API method that will empty the pipelined data, forcing an Ajax
    // fetch on the next draw (i.e. `table.clearPipeline().draw()`)
    $.fn.dataTable.Api.register( 'clearPipeline()', function () {
        return this.iterator( 'table', function ( settings ) {
            settings.clearCache = true;
        } );
    } );

    $(document).ready(function () {
        setTimeout(function () {

            $('.dataTables_length label select').niceSelect();
            $(function () {
                $('.dataTables_length label .nice-select').addClass('dataTable_select');
            });
            $('.dataTables_length label .nice-select').on('click', function () {
                $(this).toggleClass('open_selectlist');
            })
        }, 1000);
    });

    $(document).on('click', '#delete_item', function (e) {
        e.preventDefault();
        var url = $(this).data('url');

        $('#deleteBizAjaxItemModal').modal('show');
        $('#item_delete_form').attr('action', url);

    });

}(jQuery));

function getFileName(value, placeholder){
    "use strict";
    if (value) {
        var startIndex = (value.indexOf('\\') >= 0 ? value.lastIndexOf('\\') : value.lastIndexOf('/'));
        var filename = value.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
            filename = filename.substring(1);
        }
        $(placeholder).attr('placeholder', '');
        $(placeholder).attr('placeholder', filename);
    }
}
