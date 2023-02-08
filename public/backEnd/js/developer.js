"use strict";
// for upload attach file when apply leave
var fileInput = document.getElementById('attach_file');
if (fileInput) {

    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";

        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderAttachFile').placeholder = fileName;
    }
}

// for global modal
$(document).ready(function () {
    $('body').on("click", ".modalLink", function (e) {

        e.preventDefault();
        $('.modal-backdrop').show();
        $("#showDetaildModal").show();
        $("div.modal-dialog").removeClass('modal-md');
        $("div.modal-dialog").removeClass('modal-lg');
        $("div.modal-dialog").removeClass('modal-bg');
        var modal_size = $(this).attr('data-modal-size');
        if (modal_size !== '' && typeof modal_size !== typeof undefined && modal_size !== false) {
            $("#modalSize").addClass(modal_size);
        } else {
            $("#modalSize").addClass('modal-md');
        }
        var title = $(this).attr('title');
        $("#showDetaildModalTile").text(title);
        var data_title = $(this).attr('data-original-title');
        $("#showDetaildModalTile").text(data_title);
        $("#showDetaildModal").modal('show');
        $('div.ajaxLoader').show();
        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            success: function (data) {
                $("#showDetaildModalBody").html(data);
                $("#showDetaildModal").modal('show');
            }
        });
    });
});

// for global Delete
$(document).ready(function () {
    $('body').on("click", ".deleteUrl", function (e) {
        e.preventDefault();
        $('.modal-backdrop').show();
        $("#showDetaildModal").show();
        $("div.modal-dialog").removeClass('modal-md');
        $("div.modal-dialog").removeClass('modal-lg');
        $("div.modal-dialog").removeClass('modal-bg');
        var modal_size = $(this).attr('data-modal-size');
        if (modal_size !== '' && typeof modal_size !== typeof undefined && modal_size !== false) {
            $("#modalSize").addClass(modal_size);
        } else {
            $("#modalSize").addClass('modal-md');
        }
        var title = $(this).attr('title');
        $("#showDetaildModalTile").text(title);
        var data_title = $(this).attr('data-original-title');
        $("#showDetaildModalTile").text(data_title);
        $("#showDetaildModal").modal('show');
        $('div.ajaxLoader').show();
        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            success: function (data) {
                $("#showDetaildModalBody").html(data);
                $("#showDetaildModal").modal('show');
            }
        });
    });
});

// select staff name from selecting role name
$(document).ready(function () {
    $("#staffNameByRole").on('change', function () {
        var url = $('#url').val();
        var formData = {
            id: $(this).val()
        };
        // get section for student
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'staffNameByRole',
            success: function (data) {
                var a = '';
                $.each(data, function (i, item) {
                    if (item.length) {
                        $('#selectStaffs').find('option').not(':first').remove();
                        $('#selectStaffsDiv ul').find('li').not(':first').remove();
                        $.each(item, function (i, staffs) {
                            $('#selectStaffs').append($('<option>', {
                                value: staffs.id,
                                text: staffs.full_name
                            }));
                            $("#selectStaffsDiv ul").append("<li data-value='" + staffs.id + "' class='option'>" + staffs.full_name + "</li>");
                        });
                    } else {
                        $('#selectStaffsDiv .current').html('SELECT *');
                        $('#selectStaffs').find('option').not(':first').remove();
                        $('#selectStaffsDiv ul').find('li').not(':first').remove();
                    }
                });
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});










// select item name from selecting item category name
$(document).ready(function () {
    $("#item_category_id").on('change', function () {
        var url = $('#url').val();
        var formData = {
            id: $(this).val()
        };
        console.log(formData);
        $.ajax({
            type: "GET",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'getItemByCategory',
            success: function (data) {
                var a = '';
                $.each(data, function (i, item) {
                    if (item.length) {
                        $('#selectItems').find('option').not(':first').remove();
                        $('#selectItemsDiv ul').find('li').not(':first').remove();
                        $.each(item, function (i, items) {
                            $('#selectItems').append($('<option>', {
                                value: items.id,
                                text: items.item_name
                            }));
                            $("#selectItemsDiv ul").append("<li data-value='" + items.id + "' class='option'>" + items.item_name + "</li>");
                        });
                    } else {
                        $('#selectItemsDiv .current').html('SELECT *');
                        $('#selectItems').find('option').not(':first').remove();
                        $('#selectItemsDiv ul').find('li').not(':first').remove();
                    }
                });
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});


// for add staff earnings in payroll
function addMoreEarnings() {
    "use strict";
    var table = document.getElementById("tableID");
    var table_len = (table.rows.length);
    var id = parseInt(table_len);
    var row = table.insertRow(table_len).outerHTML = "<tr id='row" + id + "'><td width='70%' class='pr-30'><div class='input-effect mt-10'><input class='primary-input form-control' type='text' id='earningsType" + id + "' name='earningsType[]'><label for='earningsType" + id + "'>Type</label><span class='focus-border'></span></div></td><td width='20%' class='pr-30'><div class='input-effect mt-10'><input class='primary-input form-control' type='number' id='earningsValue" + id + "' name='earningsValue[]'><label for='earningsValue" + id + "'>Value</label><span class='focus-border'></span></div></td><td width='10%' class='pt-30'><button class='primary-btn icon-only fix-gr-bg close-deductions' onclick='delete_earings(" + id + ")'><span class='ti-close'></span></button></td></tr>";
}

function delete_earings(id) {
    "use strict";
    var table = document.getElementById("tableID");
    var rowCount = table.rows.length;
    $("#row" + id).html("");
}

// for minus staff deductions in payroll
function addDeductions() {
    "use strict";
    var table = document.getElementById("tableDeduction");
    var table_len = (table.rows.length);
    var id = parseInt(table_len);
    var row = table.insertRow(table_len).outerHTML = "<tr id='DeductionRow" + id + "'><td width='70%' class='pr-30'><div class='input-effect mt-10'><input class='primary-input form-control' type='text' id='deductionstype" + id + "' name='deductionstype[]'><label for='deductionstype" + id + "'>Type</label><span class='focus-border'></span></div></td><td width='20%' class='pr-30'><div class='input-effect mt-10'><input class='primary-input form-control' type='number' id='deductionsValue" + id + "' name='deductionsValue[]'><label for='deductionsValue" + id + "'>Value</label><span class='focus-border'></span></div></td><td width='10%' class='pt-30'><button class='primary-btn icon-only fix-gr-bg close-deductions' onclick='delete_deduction(" + id + ")'><span class='ti-close'></span></button></td></tr>";
}

function delete_deduction(id) {
    "use strict";
    var tables = document.getElementById("tableDeduction");
    var rowCount = tables.rows.length;
    $("#DeductionRow" + id).html("");
}

// payroll calculate for staff
function calculateSalary() {
    "use strict";
    var basicSalary = $("#basicSalary").val();
    if (basicSalary == 0) {
        alert('Please Add Employees Basic Salary from Staff Update Form First');
    } else {
        var earningsType = document.getElementsByName('earningsValue[]');
        var earningsValue = document.getElementsByName('earningsValue[]');
        var tax = $("#tax").val();
        var total_earnings = 0;
        var total_deduction = 0;
        var deductionstype = document.getElementsByName('deductionstype[]');
        var deductionsValue = document.getElementsByName('deductionsValue[]');
        for (var i = 0; i < earningsValue.length; i++) {
            var inp = earningsValue[i];
            if (inp.value == '') {
                var inpvalue = 0;
            } else {
                var inpvalue = inp.value;
            }
            total_earnings += parseInt(inpvalue);
        }
        for (var j = 0; j < deductionsValue.length; j++) {
            var inpd = deductionsValue[j];
            if (inpd.value == '') {
                var inpdvalue = 0;
            } else {
                var inpdvalue = inpd.value;
            }
            total_deduction += parseInt(inpdvalue);
        }
        var gross_salary = parseInt(basicSalary) + parseInt(total_earnings) - parseInt(total_deduction);
        var net_salary = parseInt(basicSalary) + parseInt(total_earnings) - parseInt(total_deduction) - parseInt(tax);

        $("#total_earnings").val(total_earnings);
        $("#total_deduction").val(total_deduction);
        $("#gross_salary").val(gross_salary);
        $("#final_gross_salary").val(gross_salary);
        $("#net_salary").val(net_salary);

        if ($('#total_earnings').val() != '') {
            $('#total_earnings').focus();
        }

        if ($('#total_deduction').val() != '') {
            $('#total_deduction').focus();
        }

        if ($('#net_salary').val() != '') {
            $('#net_salary').focus();
        }
    }
}


$("select.niceSelect").on('change', function () {
    $('.modal_input_validation').hide();
});


// for upload attach file when add Homework
var fileInput = document.getElementById('homework_file');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderHomeworkName').placeholder = fileName;
    }
}
// for upload content when change in role in available for
$(document).ready(function () {
    $('body').on("change", "#available_for", function (e) {
        e.preventDefault();
        role_id = $(this).val();
        if (role_id == '2') {
            $(".forStudentWrapper").slideDown();
        } else {
            $(".forStudentWrapper").slideUp();
        }
    });
});
// for staff photo  in Staff Add Module
var fileInput = document.getElementById('staff_photo');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderStaffsName').placeholder = fileName;
    }
}
// for upload content in teacher module
var fileInput = document.getElementById('upload_content_file');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderUploadContent').placeholder = fileName;
    }
}
// for upload Event File  in communication module
var fileInput = document.getElementById('upload_event_image');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        document.getElementById('placeholderEventFile').placeholder = fileName;
    }
}
// for upload Holiday File  in communication module
var fileInput = document.getElementById('upload_holiday_image');
if (fileInput) {
    fileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var fileInput = event.srcElement;
        var fileName = fileInput.files[0].name;
        console.log(fileName);
        document.getElementById('placeholderHolidayFile').placeholder = fileName;
    }
}



function printDiv(divID) {
    //Get the HTML of div
    var divElements = document.getElementById(divID).innerHTML;
    //Get the HTML of whole page
    var oldPage = document.body.innerHTML;
    //Reset the page's HTML with div's HTML only
    document.body.innerHTML = "<html><head><title></title></head><body>" + divElements + "</body>";
    //Print Page
    window.print();
    //Restore orignal HTML
    document.body.innerHTML = oldPage;
}


// in communication send To tab selected
$(".nav-link").on('click', function () {
    var selectTab = $(this).attr('selectTab');
    $("#selectTab").val(selectTab);
    $("#initialselectTab").val();
});


// for upload resume  in Staff Add Module
var resumefileInput = document.getElementById('resume');
if (resumefileInput) {
    resumefileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var resumefileInput = event.srcElement;
        var fileName = resumefileInput.files[0].name;
        document.getElementById('placeholderResume').placeholder = fileName;
    }
}

// for upload joining_letter  in Staff Add Module
var joining_letterfileInput = document.getElementById('joining_letter');
if (joining_letterfileInput) {
    joining_letterfileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var joining_letterfileInput = event.srcElement;
        var fileName = joining_letterfileInput.files[0].name;
        document.getElementById('placeholderJoiningLetter').placeholder = fileName;
    }
}

// for upload other Document  in Staff Add Module
var other_documentfileInput = document.getElementById('other_document');
if (other_documentfileInput) {
    other_documentfileInput.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var other_documentfileInput = event.srcElement;
        var fileName = other_documentfileInput.files[0].name;
        document.getElementById('placeholderOthersDocument').placeholder = fileName;
    }
}


// for upload main School logo in General Settings
var upload_logo = document.getElementById('logo_wrapper');
if (upload_logo) {
    upload_logo.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var upload_logo = event.srcElement;
        var fileName = upload_logo.files[0].name;

    }
}

// for document upload in profile View
var staff_upload_document = document.getElementById('staff_upload_document');
if (staff_upload_document) {
    staff_upload_document.addEventListener('change', showFileName);

    function showFileName(event) {
        "use strict";
        var staff_upload_document = event.srcElement;
        var fileName = staff_upload_document.files[0].name;

    }
}



function CRMTableThreeReactive(){
    if ($('.Crm_table_active3').length) {
        $('.Crm_table_active3').DataTable({
            bLengthChange: false,
            "bDestroy": true,
            language: {
                search: "<i class='ti-search'></i>",
                searchPlaceholder: 'Quick Search',
                paginate: {
                    next: "<i class='ti-arrow-right'></i>",
                    previous: "<i class='ti-arrow-left'></i>"
                }
            },
            dom: 'Bfrtip',
            buttons: [
            {
                extend: 'copyHtml5',
                text: '<i class="fa fa-files-o"></i>',
                title : $("#logo_title").val(),
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
                title : $("#logo_title").val(),
                margin: [10 ,10 ,10, 0],
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
                title : $("#logo_title").val(),
                titleAttr: 'PDF',
                exportOptions: {
                    columns: ':visible',
                    columns: ':not(:last-child)',
                },
                orientation: 'landscape',
                pageSize: 'A4',
                margin: [ 0, 0, 0, 12 ],
                alignment: 'center',
                header: true,
                customize: function ( doc ) {
                    doc.content.splice( 1, 0, {
                        margin: [ 0, 0, 0, 12 ],
                        alignment: 'center',
                        image: "data:image/png;base64,"+$("#logo_img").val()
                    } );
                }

            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i>',
                titleAttr: 'Print',
                title : $("#logo_title").val(),
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
}



function checkNaN(variable){
    return isNaN(variable) ? 0 : variable;
}
