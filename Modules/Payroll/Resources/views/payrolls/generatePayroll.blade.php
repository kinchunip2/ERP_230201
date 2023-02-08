@extends('backEnd.master')
@section('mainContent')

    <section class="student-details mb-40">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-2">{{ __('payroll.Generate Payroll') }}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="student-meta-box">
                        <div class="student-meta-top staff-meta-top"></div>
                        <img class="student-meta-img img-100"
                            src="{{ asset($staffDetails->avatar ?? 'public/backEnd/img/Fred_man-512.png') }}" alt="">
                        <div class="white-box">
                            <div class="single-meta mt-20">
                                <div class="row">
                                    <div class="col-lg-2 col-md-6">
                                        <div class="name">
                                            {{ __('common.Name') }}
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <div class="value text-left">
                                            @if (isset($staffDetails)){{ $staffDetails->name }}@endif
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <div class="name">
                                            {{ __('common.Staff ID') }}
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-6">
                                        <div class="value text-left">
                                            @if (isset($staffDetails) && $staffDetails->staff){{ $staffDetails->staff->employee_id }}@endif
                                        </div>
                                    </div>
                                    <div class="col-lg-1 col-md-3">
                                        <div class="value text-left">
                                            {{ __('attendance.Month') }}
                                        </div>
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="{{ __('attendance.Present') }}">
                                        {{ __('attendance.P') }}
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="{{ __('attendance.Late') }}">
                                        {{ __('attendance.L') }}
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip" title="{{ __('attendance.Absent') }}">
                                        {{ __('attendance.A') }}
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip"
                                        title="{{ __('attendance.Half Day') }}">
                                        {{ __('attendance.F') }}
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip"
                                        title="{{ __('attendance.Holiday') }}">
                                        {{ __('attendance.H') }}
                                    </div>
                                    <div class="value ml-20" data-toggle="tooltip"
                                        title="{{ __('attendance.Approved Leave') }}">
                                        {{ __('attendance.V') }}
                                    </div>
                                </div>
                            </div>

                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        {{ __('common.Phone') }}
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        @if (isset($staffDetails) && $staffDetails->staff){{ $staffDetails->staff->phone }}@endif
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        {{ __('common.Email') }}
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        @if (isset($staffDetails)){{ $staffDetails->email }}@endif
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-3">
                                    <div class="value text-left">
                                        {{ __('common.' . $payroll_month) }}
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-9 d-flex">
                                    <div class="value ml-20">
                                        {{ $p }}
                                    </div>
                                    <div class="value ml-20">
                                        {{ $l }}
                                    </div>
                                    <div class="value ml-20">
                                        {{ $a }}
                                    </div>
                                    <div class="value ml-20">
                                        {{ $f }}
                                    </div>
                                    <div class="value ml-20">
                                        {{ $h }}
                                    </div>
                                    <div class="value ml-20">
                                        V
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        {{ __('role.Role') }}
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        @if (isset($staffDetails)){{ $staffDetails->role->name }}@endif
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        {{ __('department.Department') }}
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        @if (isset($staffDetails) && $staffDetails->staff){{ $staffDetails->staff->department->name }}@endif
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        {{ __('common.Date of Joining') }}
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        @if (isset($staffDetails) && $staffDetails->staff)
                                            {{ dateConvert($staffDetails->staff->date_of_joining) ?? '' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        {{ __('payroll.Total Loan') }}
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        {{ single_price($staffDetails->LoanInfo['total_loan']) }}
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        {{ __('payroll.Due Loan Amount') }}
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        {{ single_price($staffDetails->LoanInfo['total_due']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-meta">
                            <div class="row">
                                <div class="col-lg-2 col-md-6">
                                    <div class="name">
                                        {{ __('payroll.Paid Amount') }}
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-6">
                                    <div class="value text-left">
                                        {{ single_price($staffDetails->LoanInfo['total_paid']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <form class="" action="{{ route('save_payroll') }}" method="post" enctype="multipart/form-data">
        @csrf
        <section class="">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="d-flex justify-content-between mb-20">
                            <div class="main-title">
                                <h3>{{ __('payroll.Earnings') }}</h3>
                            </div>

                            <div>
                                <button type="button" class="primary-btn icon-only fix-gr-bg" onclick="addMoreEarnings()">
                                    <span class="ti-plus"></span>
                                </button>
                            </div>
                        </div>

                        <div class="white-box">
                            <table class="w-100" id="tableID">
                                <tbody id="addEarningsTableBody">
                                    <tr id="row0">
                                        <td width="80%" class="pr-30">
                                            <div class="input-effect mt-10">
                                                <input class="primary-input form-control" type="text" id="earningsType0"
                                                    name="earningsType[]">
                                                <label for="earningsType0">{{ __('payroll.Type') }}</label>
                                                <span class="focus-border"></span>
                                            </div>
                                        </td>
                                        <td width="20%">
                                            <div class="input-effect mt-10">
                                                <input class="primary-input form-control" type="number" step='0.01'
                                                    oninput="this.value = Math.abs(this.value)" id="earningsValue0"
                                                    name="earningsValue[]">
                                                <label for="earningsValue0">{{ __('payroll.Value') }}</label>
                                                <span class="focus-border"></span>
                                            </div>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-4 no-gutters">
                        <div class="d-flex justify-content-between mb-20">
                            <div class="main-title">
                                <h3>{{ __('payroll.Deductions') }}</h3>
                            </div>

                            <div>
                                <button type="button" class="primary-btn icon-only fix-gr-bg" onclick="addDeductions()">
                                    <span class="ti-plus"></span>
                                </button>
                            </div>
                        </div>

                        <div class="white-box">
                            <table class="w-100 table-responsive" id="tableDeduction">
                                <tbody id="addDeductionsTableBody">
                                    @isset($loans)
                                        @if (count($loans) > 0)
                                            @foreach ($loans as $key => $loan)
                                                <input type="hidden" name="loan_id[]" value="{{ $loan->id }}">
                                                <input type="hidden" name="paid_loans[]"
                                                    value="{{ $loan->monthly_installment }}">
                                                <tr id="DeductionRow{{ $key + 1 }}">
                                                    <td width="60%" class="pr-30">
                                                        <div class="input-effect mt-10">
                                                            <input class="primary-input form-control" type="text"
                                                                id="deductionstype0" name="deductionstype[]"
                                                                value="{{ $loan->title }} - {{ __('payroll.Loan') }}"
                                                                readonly>
                                                            <label for="deductionstype0">{{ __('payroll.Type') }}</label>
                                                            <span class="focus-border"></span>
                                                        </div>
                                                    </td>
                                                    <td width="20%">
                                                        <div class="input-effect mt-10">
                                                            <input class="primary-input form-control" type="number" step='0.01'
                                                                oninput="this.value = Math.abs(this.value)"
                                                                value="{{ $loan->monthly_installment }}"
                                                                id="deductionsValue0" name="deductionsValue[]">
                                                            <label for="deductionsValue0">{{ __('payroll.Value') }}</label>
                                                            <span class="focus-border"></span>
                                                        </div>
                                                    </td>
                                                    <td width="20%">
                                                        <div class="input-effect mt-10">
                                                            <label for="deductionsstatus0">{{ __('payroll.Loan') }}</label>
                                                            <input type="checkbox" id="checkbox0" value="1" name="loanStatus[]"
                                                                checked>
                                                            <span class="focus-border"></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr id="DeductionRow0">
                                                <td width="60%" class="pr-30">
                                                    <div class="input-effect mt-10">
                                                        <input class="primary-input form-control" type="text"
                                                            id="deductionstype0" name="deductionstype[]">
                                                        <label for="deductionstype0">{{ __('payroll.Type') }}</label>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </td>
                                                <td width="20%">
                                                    <div class="input-effect mt-10">
                                                        <input class="primary-input form-control" type="number" step='0.01'
                                                            oninput="this.value = Math.abs(this.value)" id="deductionsValue0"
                                                            name="deductionsValue[]">
                                                        <label for="deductionsValue0">{{ __('payroll.Value') }}</label>
                                                        <span class="focus-border"></span>
                                                    </div>
                                                </td>
                                                <td width="20%">
                                                    <div class="input-effect mt-10">
                                                        <label
                                                            for="deductionsstatus0">{{ __('payroll.Loan Status') }}</label>
                                                        <input type="checkbox" class='primary-input ' id="checkbox0" value="0">
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-4 no-gutters">
                        <div class="d-flex justify-content-between mb-20">
                            <div class="main-title">
                                <h3>{{ __('payroll.Payroll Summary') }}</h3>
                            </div>

                            <div>
                                <button type="button" class="primary-btn small fix-gr-bg" onclick="calculateSalary()">
                                    {{ __('payroll.Calculate') }}
                                </button>
                            </div>
                        </div>

                        <input type="hidden" name="staff_id" @if ($staffDetails->staff) value="{{ $staffDetails->staff->id }}" @endif>
                        <input type="hidden" name="payroll_month" value="{{ $payroll_month }}">
                        <input type="hidden" name="payroll_year" value="{{ $payroll_year }}">
                        <input type="hidden" name="role_id" value="{{ $staffDetails->role_id }}">


                        <div class="white-box">
                            <table class="w-100 table-responsive">
                                <tbody class="d-block">
                                    <tr class="d-block">
                                        <td width="100%" class="pr-30 d-block">
                                            <label class="primary_input_label"
                                                for="">{{ __('payroll.Basic Salary') }}</label>
                                            <input name="basic_salary" id="basicSalary" readonly class="primary_input_field"
                                                type="text" @if ($staffDetails->staff) value="{{ $staffDetails->staff->basic_salary }}" @endif>
                                        </td>
                                    </tr>
                                    <tr class="d-block">
                                        <td width="100%" class="pr-30 d-block">
                                            <label class="primary_input_label"
                                                for="">{{ __('payroll.Earnings') }}</label>
                                            <input name="total_earnings" id="total_earnings" readonly
                                                class="primary_input_field" type="text" value="0">
                                        </td>
                                    </tr>
                                    <tr class="d-block">
                                        <td width="100%" class="pr-30 d-block">
                                            <label class="primary_input_label"
                                                for="">{{ __('payroll.Deductions') }}</label>
                                            <input name="total_deduction" id="total_deduction" readonly
                                                class="primary_input_field" type="text" value="0">
                                        </td>
                                    </tr>
                                    <tr class="d-block">
                                        <td width="100%" class="pr-30 d-block">
                                            <label class="primary_input_label"
                                                for="">{{ __('payroll.Gross Salary') }}</label>
                                            <input name="final_gross_salary" id="final_gross_salary" readonly
                                                class="primary_input_field" type="text" value="0">
                                        </td>
                                    </tr>
                                    <tr class="d-block">
                                        <td width="100%" class="pr-30 d-block">
                                            <label class="primary_input_label" for="">{{ __('payroll.Tax') }}</label>
                                            <input name="tax" id="tax" class="primary_input_field" type="text" value="0">
                                        </td>
                                    </tr>
                                    <tr class="d-block">
                                        <td width="100%" class="pr-30 d-block">
                                            <div class="input-effect mt-30 mb-30">
                                                <input
                                                    class="primary-input form-control{{ $errors->has('net_salary') ? ' is-invalid' : '' }}"
                                                    readonly type="text" id="net_salary" name="net_salary">
                                                <label for="net_salary" {{ __('payroll.Net Salary') }}></label>
                                                <span class="focus-border"></span>

                                                @if ($errors->has('net_salary'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('net_salary') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-12 mt-20 text-right">
                            <button class="primary-btn fix-gr-bg">
                                <span class="ti-check"></span>
                                {{ __('common.Save') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

    <!-- End Modal Area -->
@endsection
@push('scripts')
    <script type="text/javascript">
        // payroll calculate for staff
        function calculateSalary() {
            var basicSalary = checkNaN(parseFloat($("#basicSalary").val()));
            if (basicSalary == 0) {
                toastr.warning('Please Add Employees Basic Salary from Staff Update Form First');
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
                    total_earnings += checkNaN(parseFloat(inpvalue));
                }
                for (var j = 0; j < deductionsValue.length; j++) {
                    var inpd = deductionsValue[j];
                    if (inpd.value == '') {
                        var inpdvalue = 0;
                    } else {
                        var inpdvalue = inpd.value;
                    }
                    total_deduction += checkNaN(parseFloat(inpdvalue));
                }
                var gross_salary = basicSalary + total_earnings - total_deduction;
                var net_salary = basicSalary + total_earnings - total_deduction - tax;

                $("#total_earnings").val(total_earnings.toFixed(2));
                $("#total_deduction").val(total_deduction.toFixed(2));
                $("#gross_salary").val(gross_salary.toFixed(2));
                $("#final_gross_salary").val(gross_salary.toFixed(2));
                $("#net_salary").val(net_salary.toFixed(2));

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

        // for add staff earnings in payroll
        function addMoreEarnings() {
            var table = document.getElementById("tableID");
            var table_len = (table.rows.length);
            var id = parseInt(table_len);
            var row = table.insertRow(table_len).outerHTML = "<tr id='row" + id +
                "'><td width='70%' class='pr-30'><div class='input-effect mt-10'><input class='primary-input form-control has-content' type='text' id='earningsType" +
                id + "' name='earningsType[]'><label for='earningsType" + id + "'>" + trans('js.type') +
                "</label><span class='focus-border'></span></div></td><td width='20%'><div class='input-effect mt-10'><input class='primary-input form-control has-content' type='number' step='0.01' oninput='this.value = Math.abs(this.value)' id='earningsValue" +
                id + "' name='earningsValue[]'><label for='earningsValue" + id + "'>" + trans('js.value') +
                "</label><span class='focus-border'></span></div></td><td width='10%' class='pt-30'><button class='primary-btn icon-only fix-gr-bg close-deductions' onclick='delete_earings(" +
                id + ")'><span class='ti-close'></span></button></td></tr>";
        }

        function delete_earings(id) {
            var table = document.getElementById("tableID");
            var rowCount = table.rows.length;
            $("#row" + id).html("");
        }

        // for minus staff deductions in payroll
        function addDeductions() {
            var table = document.getElementById("tableDeduction");
            var table_len = (table.rows.length);
            var id = parseInt(table_len);
            var row = table.insertRow(table_len).outerHTML = "<tr id='DeductionRow" + id +
                "'><td width='50%' class='pr-30'><div class='input-effect mt-10'><input class='primary-input form-control has-content' type='text' id='deductionstype" +
                id + "' name='deductionstype[]'><label for='deductionstype" + id + "'>" + trans('js.type') +
                "</label><span class='focus-border'></span></div></td><td width='20%'><div class='input-effect mt-10'><input class='primary-input form-control has-content' oninput='this.value = Math.abs(this.value)' type='number' step='0.01' id='deductionsValue" +
                id + "' name='deductionsValue[]'><label for='deductionsValue" + id + "'>" + trans('js.value') +
                "</label><span class='focus-border'></span></div></td><td width='10%'><div class='input-effect mt-10'><input class='read-only-input' type='checkbox' id='loanStatus" +
                id +
                "' name='loanStatus[]'></div></td><td width='10%' class='pt-30'><button type='button' class='primary-btn icon-only fix-gr-bg close-deductions' onclick='delete_deduction(" +
                id + ")'><span class='ti-close'></span></button></td></tr>";
        }

        function delete_deduction(id) {
            var tables = document.getElementById("tableDeduction");
            var rowCount = tables.rows.length;
            rowCount.closest("tr").remove();

        }
    </script>
@endpush
