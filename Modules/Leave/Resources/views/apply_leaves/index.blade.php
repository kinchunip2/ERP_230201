@extends('backEnd.master')
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('leave.Apply Leave') }}</h3>

                            @if(permissionCheck('apply_leave.store'))
                                <ul class="d-flex">
                                    <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="#" data-toggle="modal"
                                           data-target="#ApplyLeave"><i
                                                class="ti-plus"></i>{{ __('leave.Apply New Leave') }}</a></li>
                                </ul>
                                @endif

                        </div>
                    </div>
                </div>
                @php
                   
                  
                        $remaining_leave_days = 0;
                        $extra_leave_days =  0;
                        $total = $total_leave;

                                if ($total > $apply_leave_histories->where('status',1)->sum('total_days')) {
                                    $remaining_leave_days = $total - $apply_leave_histories->where('makeup_leave',0)->where('status',1)->sum('total_days');
                                }else {
                                    $extra_leave_days =  $apply_leave_histories->where('makeup_leave',0)->where('status',1)->sum('total_days') - $total;
                                }
                   
                @endphp
                <div class="col-lg-12 mb-3">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="white-box single-summery">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3>{{ __('leave.Total Leave') }}</h3>
                                    </div>
                                    <h1 class="gradient-color2">{{ $total + Auth::user()->staff->carry_forward }} {{__('leave.Days')}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="white-box single-summery">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3>{{ __('leave.Remaining Total Leave') }}</h3>
                                    </div>
                                    <h1 class="gradient-color2">{{ $remaining_leave_days }} {{__('leave.Days')}}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="white-box single-summery">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h3>{{ __('leave.Extra Taken Leave') }}</h3>
                                    </div>
                                    <h1 class="gradient-color2">{{ $extra_leave_days }} {{__('leave.Days')}}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="apply_leave_list">
                                <table class="table Crm_table_active">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ __('common.Sl') }}</th>
                                        <th scope="col">{{ __('leave.Type') }}</th>
                                        <th scope="col">{{ __('leave.From') }}</th>
                                        <th scope="col">{{ __('leave.To') }}</th>
                                        <th scope="col">{{ __('leave.Apply Date') }}</th>
                                        <th scope="col">{{ __('common.Status') }}</th>
                                        <th scope="col">{{ __('common.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($apply_leaves as $key => $apply_leave)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $apply_leave->leave_type->name }}</td>

                                            <td>{{ showDate($apply_leave->start_date) }}</td>
                                            <td>{{ $apply_leave->end_date != '0000-00-00' ? showDate($apply_leave->end_date) : '' }}</td>
                                            <td>{{ showDate($apply_leave->apply_date) }}</td>
                                            <td>
                                                @if ($apply_leave->status == 0)
                                                    <span class="badge_3">Pending</span>
                                                @elseif ($apply_leave->status == 1)
                                                    <span class="badge_1">Approved</span>
                                                @else
                                                    <span class="badge_4">Cancelled</span>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- shortby  -->
                                                <div class="dropdown CRM_dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            id="dropdownMenu2" data-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false">
                                                        {{ __('common.Select') }}
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right"
                                                         aria-labelledby="dropdownMenu2">
                                                        @if (permissionCheck('apply_leave.edit'))
                                                            @if ($apply_leave->status == 0)
                                                                <a href="javascript:void(0)" class="dropdown-item"
                                                                   onclick="edit_apply_leave_modal({{ $apply_leave->id }})">{{__('common.Edit')}}</a>
                                                            @else
                                                                <a href="#"
                                                                   class="dropdown-item">{{__('common.Approved')}}</a>
                                                            @endif
                                                        @endif
                                                        <a href="{{route('leave.application.download',$apply_leave->id)}}"
                                                           class="dropdown-item">{{__('common.Download')}}</a>
                                                        @if (permissionCheck('apply_leave.destroy') and $apply_leave->status == 0)
                                                            <a onclick="confirm_modal('{{route('apply_leave.destroy', $apply_leave->id)}}');"
                                                               class="dropdown-item">{{__('common.Delete')}}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <!-- shortby  -->
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(permissionCheck('apply_leave.store'))
    <div class="modal fade admin-query" id="ApplyLeave">
        <div class="modal-dialog modal_800px modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('leave.Apply New Leave') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="ti-close"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="#" method="POST" id="apply_leave_Form"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @if(Auth::user()->role->type == 'system_user')
                                <div class="col-xl-6">
                                    <div class="primary_input mb-25">
                                        <label class="primary_input_label" for="">{{ __('common.User') }} *</label>
                                        <select class="primary_select mb-25 department_id" name="user"
                                                id="department_id" required>
                                            @foreach ($users as $key => $user)
                                                <option
                                                    value="{{ $user->id }}" {{ $user->id == Auth::id() ? "selected" : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="user_id_error"></span>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="user" value="{{Auth::id()}}">
                            @endif
                            <div class="col-xl-6">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">{{ __('leave.Apply Date') }} *</label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="{{ __('common.Date') }}"
                                                           class="primary_input_field primary-input date form-control"
                                                           id="apply_date" type="text" name="apply_date"
                                                           value="{{date('m/d/Y')}}"
                                                           autocomplete="off" required>
                                                </div>
                                            </div>
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('leave.Leave Type') }} *</label>
                                    <select class="primary_select mb-25" name="leave_type_id" id="leave_type_id"
                                            required>
                                        @foreach (\Modules\Leave\Entities\LeaveType::Active()->get() as $leave_type)
                                            <option value="{{ $leave_type->id }}">{{ $leave_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="leave_day">{{ __('leave.Leave') }} *</label>
                                    <select class="primary_select day mb-25" name="day"
                                            id="leave_day">
                                        <option value="0">{{ __('leave.Half Day') }}</option>
                                        <option value="1">{{ __('leave.Single Day') }}</option>
                                        <option value="2">{{ __('leave.Multiple Day') }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label leave_date">{{ __('leave.Leave Date') }} *</label>
                                    <label class="primary_input_label leave_from" style="display: none">{{ __('leave.Leave From') }} * </label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="{{ __('common.Date') }}"
                                                           class="primary_input_field primary-input date form-control"
                                                           id="start_date" type="text" name="start_date"
                                                           value="{{date('m/d/Y')}}"
                                                           autocomplete="off" required>
                                                </div>
                                            </div>
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <ul id="half_day_checkbox" class="permission_list sms_list half_day_checkbox" >
                                    <li class="mr-0 pr-2 half">
                                        <label data-id="color_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="to_day" value="half" id="start_date_half_day"
                                                   class="de_active"
                                                   type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.Half Day') }}</p>
                                    </li>
                                    <li class="mr-0 pr-2 start_date_half_day_option">
                                        <label data-id="bg_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="from_day"  value="1" class="active"
                                                   type="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.First Half') }}</p>
                                    </li>
                                    <li class="mr-0 pr-2 start_date_half_day_option">
                                        <label data-id="color_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="from_day" value="2"  class="de_active"
                                                   type="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.Second Half') }}</p>
                                    </li>
                                </ul>
                                <span class="text-danger" id="from_day_error"></span>
                            </div>
                            <div class="col-xl-6 leave_to " style="display: none;">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label">{{ __('leave.Leave To') }} *</label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="{{ __('common.Date') }}"
                                                           class="primary_input_field primary-input date form-control"
                                                           id="end_date" type="text" name="end_date"
                                                           value="{{date('m/d/Y')}}"
                                                           autocomplete="off" required>
                                                </div>
                                            </div>
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                            <span class="text-danger" id="end_date_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <ul id="end_date_half_day_checkbox" class="permission_list sms_list">
                                    <li class="mr-0 pr-2">
                                        <label data-id="color_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="half_to" value="1" id="end_date_half_day"
                                                   class="de_active"
                                                   type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.Half Day') }}</p>
                                    </li>
                                    <li class="mr-0 pr-2 end_date_half_option">
                                        <label data-id="bg_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="to_day" value="1" class="active"
                                                   type="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.First Half') }}</p>
                                    </li>
                                    <li class="mr-0 pr-2 end_date_half_option">
                                        <label data-id="color_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="to_day" value="2" class="de_active"
                                                   type="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.Second Half') }}</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-2 mt-30" id="make_up_option_column">
                                <ul id="make_up_leave_checkbox" class="permission_list sms_list">
                                    <li class="mr-0 pr-2 makeup_option">
                                        <label data-id="color_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="makeup_leave" value="1" id="makeup_leave"
                                                   class="de_active"
                                                   type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.Make Up Leave') }}</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xl-4" id="make_up_option" style="display: none;">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label">{{ __('leave.Make Up Leave Date') }} *</label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="{{ __('common.Date') }}"
                                                           class="primary_input_field date primary-input form-control"
                                                           type="text" name="makeup_date"
                                                           value="{{\Carbon\Carbon::now()->addDays(1)->format('m/d/Y')}}"
                                                           autocomplete="off">
                                                </div>
                                            </div>
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                            <span class="text-danger" id="end_date_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <ul id="make_up_half_day_checkbox" class="permission_list sms_list half_day_checkbox">
                                    <li class="mr-0 pr-2">
                                        <label data-id="bg_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="makeup_half" id="status_makeup" value="1" class="active"
                                                   type="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.First Half') }}</p>
                                    </li>
                                    <li class="mr-0 pr-2 makeup_half">
                                        <label data-id="color_option"
                                               class="primary_checkbox d-flex mr-12">
                                            <input name="makeup_half" value="2" id="to_makeup_inactive"
                                                   class="de_active"
                                                   type="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{ __('leave.Second Half') }}</p>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-xl-6 reason">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('leave.Reason') }} *</label>
                                    <input name="reason" class="primary_input_field name"
                                           placeholder="{{ __('leave.Reason') }}" type="text">
                                    <span class="text-danger" id="reason_error"></span>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('leave.Attachment') }} </label>
                                    <div class="primary_file_uploader">
                                        <input class="primary-input" type="text" id="placeholderFileOneName"
                                               placeholder="{{ __('common.Browse File') }}" readonly="">
                                        <button class="" type="button">
                                            <label class="primary-btn small fix-gr-bg"
                                                   for="document_file_1">{{__("common.Browse")}} </label>
                                            <input type="file" class="d-none" name="file" id="document_file_1">
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 text-center">
                                <div class="d-flex justify-content-center pt_20">
                                    <button type="submit" class="primary-btn semi_large2 fix-gr-bg"
                                            id="save_button_parent"><i class="ti-check"></i>{{ __('common.Save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @endif

    @if(permissionCheck('apply_leave.edit'))
    <div class="edit_form">
    </div>
    @endif
    @if(permissionCheck('apply_leave.destroy'))
    @include('backEnd.partials.delete_modal')
    @endif
@endsection
@push('scripts')
    <script type="text/javascript">
        function edit_apply_leave_modal(el) {
            "use strict";
            $.post('{{ route('apply_leave.edit') }}', {_token: '{{ csrf_token() }}', id: el}, function (data) {
                $('.edit_form').html(data);
                $('#Apply_Leave_Edit').modal('show');
                $('.primary-input.date').datepicker({
                    autoClose: true,
                    setDate: new Date()
                });
                showHideLeaveDayOptionEdit($('#edit_leave_day').val())
                $('select').niceSelect();
            });
        }

        function showHideLeaveDayOption(day){
            $('.leave_to').hide();
            $('#start_date_half_day').prop('checked', false);
            $('#end_date_half_day').prop('checked', false);
            $('#make_up_option_column').show();
            $('.half').hide();
            $('.half_day_checkbox').show();

            if (day == 2){
                $('.leave_to').show();
                $('.half').show();
                $('.end_date_half_option').hide();
                $('#makeup_leave').prop('checked', false);
                $('#make_up_option_column').hide();
            } else if (day == 0) {
                $('#start_date_half_day').prop('checked', true);
                $('.half').hide();
            } else{
                $('.half_day_checkbox').hide();
            }

            showHideMakeUpDay();
            showHalfDayOptions();

        }

        function showHideLeaveDayOptionEdit(day){
            $('.edit_leave_to').hide();
            $('#edit_make_up_option_column').show();
            $('.edit_half').hide();
            $('.edit_half_day_checkbox').show();

            if (day == 2){
                $('.edit_leave_to').show();
                $('.edit_half').show();
                $('.edit_end_date_half_option').hide();
                $('#edit_make_up_option_column').hide();
            } else if (day == 0) {
                $('#edit_start_date_half_day').prop('checked', true);
                $('.edit_half').hide();
            } else{
                $('.edit_half_day_checkbox').hide();
            }

            showHideMakeUpDayEdit();
            showHalfDayOptionsEdit();

        }

        function showHalfDayOptions(){
            if ($('#end_date_half_day').is(':checked')){
                $('.end_date_half_option').show();
            } else{
                $('.end_date_half_option').hide();
            }
            console.log($('#start_date_half_day').is(':checked'))
            if ($('#start_date_half_day').is(':checked')){
                $('.start_date_half_day_option').show();
            } else{
                $('.start_date_half_day_option').hide();
            }
        }

        function showHalfDayOptionsEdit(){
            if ($('#edit_end_date_half_day').is(':checked')){
                $('.edit_end_date_half_option').show();
            } else{
                $('.edit_end_date_half_option').hide();
            }
            if ($('#edit_start_date_half_day').is(':checked')){
                $('.edit_start_date_half_day_option').show();
            } else{
                $('.edit_start_date_half_day_option').hide();
            }
        }

        function showHideMakeUpDay(){
            let make_up_checked = $('#makeup_leave').is(':checked');
            if(make_up_checked){
                $('#make_up_option').show();
            } else{
                $('#make_up_option').hide();
            }
        }

        function showHideMakeUpDayEdit(){
            let make_up_checked = $('#edit_makeup_leave').is(':checked');
            if(make_up_checked){
                $('#edit_make_up_option').show();
            } else{
                $('#edit_make_up_option').hide();
            }
        }


        $(document).on('change', '#leave_day', function(){
            let leave_day = $(this).val();
            showHideLeaveDayOption(leave_day)
        });

        $(document).on('change', '#edit_leave_day', function(){
            let leave_day = $(this).val();
            showHideLeaveDayOptionEdit(leave_day)
        });

        $(document).on('change', '#makeup_leave', function(){
            showHideMakeUpDay()
        });
        $(document).on('change', '#edit_makeup_leave', function(){
            showHideMakeUpDayEdit()
        });

        $(document).on('change', '#start_date_half_day, #end_date_half_day', function(){
            showHalfDayOptions()
        });

        $(document).on('change', '#edit_start_date_half_day, #edit_end_date_half_day', function(){
            showHalfDayOptionsEdit()
        });



        (function ($) {
            "use strict";
            $(document).ready(function (){
                showHideLeaveDayOption($('#leave_day').val())
            })
            $("#apply_leave_Form").on("submit", function (event) {
                event.preventDefault();
                let formData = $(this).serializeArray();
                $.each(formData, function (key, message) {
                    $("#" + formData[key].name + "_error").html("");
                });
                $.ajax({
                    url: "{{route("apply_leave.store")}}",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        $("#apply_leave_Form").modal("hide");
                        $("#apply_leave_Form").trigger("reset");
                        if (response.success)
                            toastr.success(response.success);
                        else
                            toastr.warning(response.error);

                        location.reload();
                    },
                    error: function (error) {
                        if (error) {
                            $.each(error.responseJSON.errors, function (key, message) {
                                $("#" + key + "_error").html(message[0]);
                            });
                        }
                    }

                });
            });

            $(document).on("submit", "#applyLeaveEditForm", function (event) {
                event.preventDefault();
                let id = $(".edit_id").val();
                let formData = $(this).serializeArray();
                $.each(formData, function (key, message) {
                    $("#edit_" + formData[key].name + "_error").html("");
                });
                $.ajax({
                    url: "{{url('/')}}" + "/leave/" + id + "/update",
                    method: "POST",
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (response) {
                        $("#Apply_Leave_Edit").modal("hide");
                        $("#Apply_Leave_Edit").trigger("reset");
                        toastr.success(response.success);
                        location.reload();
                    },
                    error: function (error) {
                        if (error) {
                            $.each(error.responseJSON.errors, function (key, message) {
                                $("#edit_" + key + "_error").html(message[0]);
                            });
                        }
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
