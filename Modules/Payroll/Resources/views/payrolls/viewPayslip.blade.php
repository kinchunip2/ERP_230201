<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/css/rtl/bootstrap.min.css"/>

    <style>

        <?php
                $font_name= !$pdf_font  ? 'DejDejaVu Sans' : $pdf_font->name;
           ?>
@font-face {
            font-family: <?php echo $font_name ?>;
            @if($pdf_font)
             src: url("{{asset('public/fonts/'.$pdf_font->font_file)}}") format('truetype');
            @endif
             font-style: normal;
        }

        body {
            font-family: <?php echo $font_name ?>, sans-serif;
        }


        @media (min-width: 992px) {
            .modal_800px {
                max-width: 1000px;
            }
        }

        table {
            border-collapse: collapse;
        }

        h1, h2, h3, h4, h5, h6 {
            margin: 0;
            color: #1B0D2F;
        }
        /* table, tr, th, td, tbody, thead, p, h1, h2, h3, h4 {
             font-family:  'Hindi Mantrakshar 01 Regular' !important;
         }*/

        .invoice_wrapper {
            max-width: 1200px;
            margin: auto;
            background: #fff;
            padding: 20px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .border_none {
            border: 0px solid transparent;
            border-top: 0px solid transparent !important;
        }

        .invoice_part_iner {
            background-color: #fff;
        }

        .invoice_part_iner h4 {
            font-size: 30px;
            font-weight: normal;
            margin-bottom: 40px;

        }

        .invoice_part_iner h3 {
            font-size: 25px;
            font-weight: normal;
            margin-bottom: 5px;

        }

        .table_border thead {
            background-color: #F6F8FA;
        }

        .table td, .table th {
            padding: 5px;
            vertical-align: top;
            border-top: 0 solid transparent;
            color: #79838b;
        }

        .table_border tr {
            border-bottom: 1px solid #000 !important;
        }

        th p span, td p span {
            color: #212E40;
        }

        .table th {
            color: #1B0D2F;
            font-weight: normal;
            border-bottom: 1px solid #000 !important;
            background-color: #fff;
        }

        p {
            font-size: 14px;
            color: #000;
        }

        h5 {
            font-size: 12px;
            font-weight: normal;
        }

        h6 {
            font-size: 10px;
            font-weight: normal;
        }

        .mt_40 {
            margin-top: 40px;
        }

        .table_style th, .table_style td {
            padding: 20px;
        }

        .invoice_info_table td {
            font-size: 10px;
            padding: 0px;
        }

        .invoice_info_table td h6 {
            color: #6D6D6D;
            font-weight: normal;
        }

        .text_right {
            text-align: right;
        }

        .virtical_middle {
            vertical-align: middle !important;
        }

        .logo_img {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .logo_img img {
            width: 100%;
        }

        .border_bottom {
            border-bottom: 1px solid #000;
        }

        .line_grid {
            display: grid;
            grid-template-columns: 100px auto;
            grid-gap: 10px;
        }

        .line_grid span {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        p {
            margin: 0;
        }

        .font_18 {
            font-size: 18px;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mb_30 {
            margin-bottom: 30px !important;
        }

        .border_table thead tr th {
            padding: 5px;
        }

        .border_table tbody tr td {
            /*border-bottom: 1px solid rgba(0, 0, 0, .05);*/
            text-align: center;
            padding: 5px;
        }

        .title_header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 40px 0 15px 0;
        }

        .border_table {
            border-top: 2px solid #000;
            border-bottom: 2px solid #000;
            text-align: left;
        }

        .border_table th,
        .border_table td {
            border-bottom: 1px solid #000;
        }

        .border_table th {
            border-right: 1px solid #000;
        }

        .border_table thead th {
            border-right: 0;
            background: #fff;
        }

        .border_table tbody tr td {
            text-align: right;
        }

        .invoice_part_iner p {
            font-size: 14px;
            color: #79838b;
            font-weight: normal;
            white-space: nowrap;
        }

        .invoice_part_iner p span {
            color: #1B0D2F;
            font-weight: normal;
        }

        .slip_boxes {
            display: flex;
            grid-gap: 5px;
            justify-content: flex-end;
        }

        .singleSlip .title {
            background: #74A1C8;
            font-size: 14px;
            text-transform: uppercase;
            color: #fff;
        }

        .singleSlip .number {
            background: #EBEBEB;
            font-size: 18px;
            color: #1B0D2F;
        }

        .singleSlip span {
            font-size: 16px;
            white-space: nowrap;
        }

        .singleSlip h4 {
            margin: 0;
            font-size: 14px;
            white-space: nowrap;
        }

        .singleSlip div {
            padding: 5px 15px;
        }

        .border_table tbody tr:last-of-type td {
            color: #1B0D2F;
            font-weight: normal;
        }

    </style>
</head>
<body>
    @php
    $setting = app('general_setting');
@endphp

    <div class="invoice_wrapper" style="margin-top: 20px">
        <!-- invoice print part here -->
        <div class="invoice_print mb_30">
            <div class="">
                <div class="invoice_part_iner">
                    <table class="table  mb_30">
                        <thead>
                        <tr>
                            <td>
                                <div class="invoice_logo">
                                    <img src="{{ asset($setting->logo ?? '/public/backEnd/img/logo_hrm.png') }}"
                                         alt="">
                                </div>
                                <p><span> {{ trans('common.Name') }}  :</span> {{ $setting->company_name }}
                                    <span>{{ trans('common.Address') }}  :</span> {{ $setting->address }}</p>
                                <p><span>{{ trans('common.Phone') }}  :</span> {{ $setting->phone }} <span>Email  : </span>{{ $setting->email }}
                                </p>
                            </td>
                            <td class="virtical_middle">
                                <div class="payslip " style="text-align: right; margin-bottom: 20px">
                                    <h3>{{ trans('payroll.Payslip') }}</h3>
                                </div>
                                <div class="slip_boxes">
                                    <div class="singleSlip">
                                        <div class="title">
                                            <span>{{ trans('payroll.Prepared By') }}</span>
                                        </div>
                                        <div class="number">
                                            <h4>{{ @$payrollDetails->user->name }}</h4>
                                        </div>
                                    </div>

                                    <div class="singleSlip">
                                        <div class="title">
                                            <span>{{ trans('payroll.Paid Date') }}</span>
                                        </div>
                                        <div class="number">
                                            <h4>{{ dateConvert($payrollDetails->payment_date) }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- invoice print part end -->
        <table class="table border_table mb_30">
            <thead>
            <tr>
                <th>{{ trans('common.Staff') }} {{ trans('common.Details') }}</th>
                <th style="text-align: right;">{{ trans('common.Total') }}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>{{ trans('common.Staff Id') }}</th>
                <td>{{ $payrollDetails->staff->employee_id }}</td>
            </tr>
            <tr>
                <th> {{ trans('common.Name') }}</th>
                <td>{{ @$payrollDetails->staff->user->name }}</td>
            </tr>
            <tr>
                <th>{{ trans('department.Department') }}</th>
                <td>{{ @$payrollDetails->staff->department->name }}</td>
            </tr>
            <tr>
                <th>{{ trans('payroll.Payment Method') }}</th>
                <td>{{ @$payrollDetails->payment_mode }}</td>
            </tr>
            <tr>
                <th>{{ trans('payroll.Basic Salary') }}</th>
                <td>{{ single_price($payrollDetails->basic_salary) }}</td>
            </tr>
            <tr>
                <th>{{ trans('payroll.Total Earning') }}</th>
                <td>{{ single_price($payrollDetails->total_earning) }}</td>
            </tr>
            <tr>
                <th>{{ trans('payroll.Total Deduction') }}</th>
                <td>{{ single_price($payrollDetails->total_deduction + $payrollDetails->tax) }}</td>
            </tr>
            <tr>
                <th>{{ trans('payroll.Net Salary') }}</th>
                <td>{{ single_price($payrollDetails->net_salary) }}</td>
            </tr>
            <!--        <tr>
                        <th>Gross Payment</th>
                        <td>34000$</td>
                    </tr>-->
            </tbody>
        </table>
    </div>

</body>
</html>
