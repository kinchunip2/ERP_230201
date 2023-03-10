@extends('backEnd.master')
@section('mainContent')

    <div id="add_payment">
        <section class="admin-visitor-area up_st_admin_visitor">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="box_header">
                            <div class="main-title d-flex">
                                <h3 class="mb-0 mr-30">{{ __('common.Add New') }} {{ __('inventory.Expense') }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="white_box_50px box_shadow_white">
                            <!-- Prefix  -->
                            <form action="{{ route('expenses.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for="">{{__('account.Date')}} *</label>
                                            <div class="primary_datepicker_input">
                                                <div class="no-gutters input-right-icon">
                                                    <div class="col">
                                                        <div class="">
                                                            <input placeholder="{{ __('account.Date') }}" value="{{date('m/d/Y')}}"
                                                                   class="primary_input_field primary-input date form-control"
                                                                   id="startDate" type="text" name="date"
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
                                    <div class="col-lg-6">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for="">{{__('account.Payment From')}}
                                                *</label>
                                            <select class="primary_select mb-15 payment_from" name="voucher_type"
                                                    id="payment_from_type" onchange="get_accounts()" required>
                                                <option>{{ __('common.Select one') }}</option>
                                                @foreach ($account_categories as $key => $account_category)
                                                    <option
                                                        value="{{ $account_category->id }}">{{ $account_category->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{$errors->first('voucher_type')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 payment_from_div">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label"
                                                   for="">{{__('account.Payment From Account')}} *</label>
                                            <div class="payment_from_account">

                                            </div>
                                            <span class="text-danger">{{$errors->first('payment_from')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label"
                                                   for=""> {{__("account.Narration")}} </label>
                                            <input class="primary_input_field" name="narration"
                                                   placeholder="{{__("account.Narration")}}" type="text"
                                                   value="{{ old('narration') }}">
                                            <span class="text-danger">{{$errors->first('narration')}}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 cheque_no_div">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label"
                                                   for=""> {{__('account.Cheque Number')}} *</label>
                                            <input class="primary_input_field" name="cheque_no" id="cheque_no"
                                                   placeholder="{{ __('account.Cheque No') }}" type="text"
                                                   value="{{old('cheque_no')}}" required>
                                            <span class="text-danger">{{$errors->first('cheque_no')}}</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 cheque_date_div">
                                        <div class="primary_input mb-15">
                                            <div class="primary_input mb-15">
                                                <label class="primary_input_label" for="">{{__('account.Cheque Date')}}
                                                    *</label>
                                                <div class="primary_datepicker_input">
                                                    <div class="no-gutters input-right-icon">
                                                        <div class="col">
                                                            <div class="">
                                                                <input placeholder="{{ __('account.Cheque Date') }}"
                                                                       class="primary_input_field primary-input date form-control"
                                                                       id="cheque_date" type="text" name="cheque_date"
                                                                       value="{{date('m/d/Y')}}" autocomplete="off"
                                                                       required>
                                                            </div>
                                                        </div>
                                                        <button class="" type="button">
                                                            <i class="ti-calendar" id="start-date-icon"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 bank_name_div">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label"
                                                   for=""> {{__('account.Bank Name')}} *</label>
                                            <input class="primary_input_field" name="bank_name" id="bank_name"
                                                   placeholder="{{ __('account.Bank Name') }}" type="text" value="{{old('bank_name')}}"
                                                   required>
                                            <span class="text-danger">{{$errors->first('bank_name')}}</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 bank_branch_div">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for=""> {{__('account.Bank Branch')}}
                                                *</label>
                                            <input class="primary_input_field" name="bank_branch" id="bank_branch"
                                                   placeholder="{{ __('account.Bank Branch') }}" type="text"
                                                   value="{{old('bank_branch')}}" required>
                                            <span class="text-danger">{{$errors->first('bank_branch')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <label class="primary_input_label text-center" for=""
                                       id="dynamic_text">{{ __('account.Please Enter Your debit details') }}</label>
                                <label class="h1 primary_input_label text-center gradient-color2" for=""
                                       id="alert_txt"></label>
                                <hr>
                                <div class="row form">
                                    <div class="col-lg-4">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for="">{{__('account.Payment To')}}
                                                *</label>
                                            <select class="primary_select mb-15 payment_to" name="sub_account_id[]"
                                                    id="debit_account_id" required>
                                                <option>{{__('account.Select one')}}</option>
                                                @foreach ($accounts as $key => $account)
                                                    <option value="{{ $account->id }}">{{ $account->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger">{{$errors->first('payment_from')}}</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for=""> {{__('account.Amount')}}*</label>
                                            <input class="primary_input_field" name="sub_amount[]"
                                                   placeholder="{{ __('account.Amount') }}" type="number" step="0.01">
                                            <span class="text-danger">{{$errors->first('sub_amount')}}</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label"
                                                   for=""> {{__('account.Narration')}} </label>
                                            <input class="primary_input_field" name="sub_narration[]"
                                                   placeholder="{{ __('account.Narration') }}" type="text">
                                            <span class="text-danger">{{$errors->first('amount')}}</span>
                                        </div>
                                    </div>

                                    <div class="col-lg-1">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label" for=""> {{__('common.Action')}} </label>
                                            <button class="primary-btn btn-sm fix-gr-bg" id="add_payment_to_form"><i
                                                    class="ti-plus"></i>{{__('account.Add')}}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="primary_input mb-15">
                                            <label class="primary_input_label"
                                                   for=""> {{__('account.Total Amount')}} </label>
                                            <input class="primary_input_field" name="sub_amounts" id="sub_amounts"
                                                   value="0" type="text" readonly>
                                            <span class="text-danger">{{$errors->first('sub_amounts')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="submit_btn text-center ">
                                            <button class="primary-btn semi_large2 fix-gr-bg"><i
                                                    class="ti-check"></i>{{__("common.Save")}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push("scripts")
    <script type="text/javascript">
        setInterval(function () {
            sum_amount();
        }, 3000);
        $(document).ready(function () {
            $('.payment_from_div').hide();
            hideDiv();
        });

        function sum_amount() {
            var sub_amounts = $("input[name='sub_amount[]']").map(function () {
                return $(this).val();
            }).get();
            var sum = 0;
            var sum = 0;
            for (var i = 0; i < sub_amounts.length; i++) {
                let sub_amount = parseFloat(sub_amounts[i]);
                if (isNaN(sub_amount)){
                    sub_amount = 0;
                }
                sum = sum + sub_amount;
            }

            $("#sub_amounts").val(sum);
        }

        function get_accounts() {
            var account_cat_id = $('#payment_from_type').val();
            $.post('{{ route('get_accounts_for_payment') }}', {
                _token: '{{ csrf_token() }}',
                id: account_cat_id
            }, function (data) {
                $('.payment_from_account').html(data);
                $('.payment_from_div').show();
                $('select').niceSelect();
            });
            if (account_cat_id == 1) {
                $("#bank_branch").attr('disabled', true);
                $("#bank_name").attr('disabled', true);
                $("#cheque_date").attr('disabled', true);
                $("#cheque_no").attr('disabled', true);
                hideDiv();
            } else if (account_cat_id == 2) {
                $("#bank_branch").removeAttr("disabled");
                $("#bank_name").removeAttr("disabled");
                $("#cheque_date").removeAttr("disabled");
                $("#cheque_no").removeAttr("disabled");
                showDiv();
            }
        }

        function hideDiv() {
            $('.cheque_no_div').hide();
            $('.cheque_date_div').hide();
            $('.bank_name_div').hide();
            $('.bank_branch_div').hide();
        }

        function showDiv() {
            $('.cheque_no_div').show();
            $('.cheque_date_div').show();
            $('.bank_name_div').show();
            $('.bank_branch_div').show();
        }

        $(document).ready(function () {
            var i = 0;
            $(document).on('click', '#add_payment_to_form', function (e) {
                i++;
                e.preventDefault();
                $(".form").append('<div class="col-lg-4 row_id_' + i + '">' +
                    '<div class="primary_input mb-15">' +
                    '<select class="primary_select mb-15 payment_to" name="sub_account_id[]" id="payment_to" required>' +
                    '<option>'+ trans('js.Select One') +'</option>' +
                    '@foreach ($accounts as $key => $chartAccount)' +
                    '<option value="{{ $chartAccount->id }}">{{ $chartAccount->name }}</option>' +
                    '@endforeach' +
                    '</select>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 row_id_' + i + '">' +
                    '<div class="primary_input mb-15">' +
                    '<input class="primary_input_field" name="sub_amount[]" placeholder="' + trans('js.Amount') + '" type="number" value="0"  step="0.01">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-4 row_id_' + i + '">' +
                    '<div class="primary_input mb-15">' +
                    '<input class="primary_input_field" name="sub_narration[]" placeholder="' + trans('js.Narration') + '" type="text" value="">' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-1 row_id_' + i + '">' +
                    '<div class="primary_input mb-15">' +
                    '<button class="primary-btn btn-sm fix-gr-bg delete_payment_to_form" data-status="' + i + '"><i class="ti-trash"></i>' + trans('js.Delete') + '</button>' +
                    '</div>' +
                    '</div>');
                $('select').niceSelect();
            });

            $(document).on('click', '.delete_payment_to_form', function (e) {
                e.preventDefault();
                var i = $(this).data('status');
                $('.row_id_' + i).remove();
            });
        });

    </script>
@endpush
