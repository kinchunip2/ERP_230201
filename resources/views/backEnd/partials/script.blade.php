<script src="{{asset('public/backEnd/vendors/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/popper.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/jquery-ui.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/jquery.data-tables.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/pdfmake.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/vfs_fonts.js')}}"></script>
<script src="{{asset('public/backEnd/js/vfs_fonts.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/jszip.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/buttons.print.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/dataTables.rowReorder.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/buttons.colVis.min.js')}}"></script>
<script src="{{ route('assets.lang.js') }}"></script>
<script src="{{ asset('public/backEnd/vendors/js/loadah.min.js') }}"></script>
<script>
    function trans(string, args){
        let value = _.get(window.jsi18n, string);

        _.eachRight(args, (paramVal, paramKey) => {
            value = paramVal.replace(`:${paramKey}`, value);
        });

        if(typeof value == 'undefined'){
            return string;
        }

        return value;
    }
</script>

<script src="{{asset('public/backEnd/vendors/js/nice-select.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/fastselect.standalone.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/raphael-min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/morris.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/moment.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/bootstrap_datetimepicker.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/daterangepicker.min.js')}}"></script>
<script>

    ;(function($){
        $.fn.datepicker.dates[LANG] = new Object({
            "days" : {!! json_encode(__('calender.days')) !!},
            "daysShort": {!! json_encode(__('calender.daysShort')) !!},
            "daysMin": {!! json_encode(__('calender.daysMin')) !!},
            "months": {!! json_encode(__('calender.months')) !!},
            "monthsShort": {!! json_encode(__('calender.monthsShort')) !!},
            "today": {!! json_encode(__('calender.today')) !!},
            "clear": {!! json_encode(__('calender.clear')) !!}
        })
    }(jQuery));

</script>
<!-- tagsinput  -->
<script src="{{asset('public/frontend/vendors/tagsinput/tagsinput.js')}}"></script>
<!-- summernote  -->
<script src="{{asset('public/frontend/vendors/text_editor/summernote-bs4.js')}}"></script>

<!-- nestable  -->
<script src="{{asset('public/frontend/vendors/nestable/jquery.nestable.js')}}"></script>

<!-- chage  -->
<script src="{{asset('public/backEnd/vendors/js/fullcalendar.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/fullcallendar-locale-all.js')}}"></script>

<!-- metisMenu js  -->
<script src="{{asset('public/frontend/js/metisMenu.js')}}"></script>

<!-- progressbar  -->
<script src="{{asset('public/frontend/vendors/progressbar/circle-progress.min.js')}}"></script>
<!-- color picker  -->
<script src="{{asset('public/frontend/vendors/color_picker/colorpicker.min.js')}}"></script>
<script src="{{asset('public/frontend/vendors/color_picker/examples_colorpicker.js')}}"></script>

<script src="{{asset('public/backEnd/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/select2/select2.min.js')}}"></script>
<script src="{{ asset('public/js/parsley.min.js') }}"></script>
<script>
    Parsley.addMessages(LANG, @json(__('parsley')));
    Parsley.setLocale(LANG);
</script>

<script src="{{asset('public/backEnd/js/main.js')}}"></script>
<script src="{{asset('public/backEnd/js/custom.js')}}"></script>
<script src="{{asset('public/backEnd/js/developer.js')}}"></script>
<script src="{{asset('public/backEnd/js/search.js')}}"></script>
<script src="{{asset('public/backEnd/vendors/js/toastr.min.js')}}"></script>
{!! Toastr::message() !!}




<script type="text/javascript">

    setTimeout(function() {
        $('.preloader').fadeOut('slow', function() {
            $(this).hide();
        });
    }, 0);

    $("#selectStaffss").select2();

    $("#checkbox").click(function () {
        if ($("#checkbox").is(':checked')) {
            $("#selectStaffss > option").prop("selected", "selected");
            $("#selectStaffss").trigger("change");
        } else {
            $("#selectStaffss > option").removeAttr("selected");
            $("#selectStaffss").trigger("change");
        }
    });

    // for select2 multiple dropdown in send email/Sms in Class tab
    $("#selectSectionss").select2();
    $("#checkbox_section").click(function () {
        if ($("#checkbox_section").is(':checked')) {
            $("#selectSectionss > option").prop("selected", "selected");
            $("#selectSectionss").trigger("change");
        } else {
            $("#selectSectionss > option").removeAttr("selected");
            $("#selectSectionss").trigger("change");
        }
    });
    $('.close_modal').on('click', function() {
        $('.custom_notification').removeClass('open_notification');
    });
    $('.notification_icon').on('click', function() {
        $('.custom_notification').addClass('open_notification');
    });
    $(document).click(function(event) {
        if (!$(event.target).closest(".custom_notification").length) {
            $("body").find(".custom_notification").removeClass("open_notification");
        }
    });

    $(document).ready(function () {
        $('#languageChange').on('change', function () {
        var str = $('#languageChange').val();
        var url = $('#url').val();
        var formData = {
            id: $(this).val()
        };
        // get section for student
        $.ajax({
            type: "POST",
            data: formData,
            dataType: 'json',
            url: url + '/' + 'language-change',
            success: function (data) {
                url= url + '/' + 'locale'+ '/' + data[0].language_universal;
                window.location.href = url;
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});
</script>

<script type="text/javascript">
    var info = '{{ app('general_setting')->company_name }}, {{ app('general_setting')->address }}, {{ app('general_setting')->phone }} , {{ app('general_setting')->email }}'
    window.dataTableHeadingText = '<div class="row"><div class="col-12"><div class="text-center"><h3>{{ app('general_setting')->company_name }}</h3><p>{{ app('general_setting')->address }}</p><p>Contact Number: {{ app('general_setting')->phone }} , Email: {{ app('general_setting')->email }}</p><p>Generated By : {{ auth()->user()->name }}</p></div></div></div>';

</script>
@stack('scripts')
<div class="modal fade animated team_modal infix_biz_modal" id="remote_modal" tabindex="-1" role="dialog" aria-labelledby="remote_modal_label" aria-hidden="true" data-backdrop="static">
</div>

<div class="modal fade animated project_modal infix_biz_modal" id="remote_modal" tabindex="-1" role="dialog" aria-labelledby="remote_modal_label" aria-hidden="true" data-backdrop="static">
</div>

<div class="modal fade animated invite_modal infix_biz_modal" id="remote_modal" tabindex="-1" role="dialog" aria-labelledby="remote_modal_label" aria-hidden="true" data-backdrop="static">
</div>
</body>
</html>
