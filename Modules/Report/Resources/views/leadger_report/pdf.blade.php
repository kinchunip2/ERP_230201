<!DOCTYPE html>
<html>
<head>

    <title>Report</title>

    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="stylesheet" href="{{asset('backEnd/')}}/css/rtl/bootstrap.min.css"/>

    <style>
         <?php
                     $pdf_font=Modules\Setting\Entities\PdfFont::where('is_active',1)->first();
                     $font_name= !$pdf_font  ? 'DejDejaVu Sans' : $pdf_font->name;
              ?>
        @font-face {
            font-family: <?php echo $font_name ?>;
            @if($pdf_font)
            src:  
            url("{{asset('public/fonts/'.$pdf_font->font_file)}}") format('truetype');
            @endif
            font-weight: 500;
            font-style: normal;
            font-display: swap;
        }

        body{
            font-family:  <?php echo $font_name ?>, sans-serif;
        }
        .invoice_heading {
            border-bottom: 1px solid black;
            padding: 20px;
            text-transform: capitalize;
        }
     
        .invoice_logo {
            text-align: left;
        }

        .invoice_no {
            text-align: right;
            color: #415094;
        }

        .invoice_info {
            padding: 20px;
            width: 100%;
            text-transform: capitalize;
            min-height: 100px;
            margin-bottom:20px;
        }
        table {
            text-align: left;
            font-family: <?php echo $font_name ?>, sans-serif;
        }

        td, th {
            color: #828bb2;
            font-size: 13px;
            font-weight: 400;
            font-family: <?php echo $font_name ?>, sans-serif;
        }

        th {
            font-weight: 600;
            font-family: <?php echo $font_name ?>, sans-serif;
        }

        p {
            font-size: 10px;
            color: #454545;
            line-height: 16px;
        }
        .a4_width {
           max-width: 210mm;
           margin: auto;
        }
    </style>
</head>
<body>
@php
    $setting = app('general_setting');
@endphp
<div class="container-fluid ">
    <div class="invoice_heading">
        <div class="invoice_logo">
            <img src="{{asset($setting->logo)}}" width="100px" alt="">
        </div>
    </div>
    <div class="invoice_info">
        <div class="invoice_logo">
            <table class="table-borderless">
                <tr>
                    <td><b>{{__('sale.Company')}}</b></td>
                    <td><b>:</b></td>
                    <td>{{$setting->company_name}}</td>
                </tr>
                <tr>
                    <td><b>{{__('common.Phone')}}</b></td>
                    <td><b>:</b></td>
                    <td>{{$setting->phone}}</td>
                </tr>
                <tr>
                    <td><b>{{__('common.Email')}}</b></td>
                    <td><b>:</b></td>
                    <td>{{$setting->email}}</td>
                </tr>
                <tr>
                    <td><b>{{__('sale.Website')}}</b></td>
                    <td><b>:</b></td>
                    <td><a href="#">infix.pos.com</a></td>
                </tr>
                <tr>
                    <td><b>{{__('common.Account Name')}}</b></td>
                    <td><b>:</b></td>
                    <td>{{ $beforedateAccount->name }}</td>
                </tr>
                @if ($dateFrom != null)
                    <tr>
                        <td><b>{{__('common.Date Range')}}</b></td>
                        <td><b>:</b></td>
                        <td>{{ showDate($dateFrom) }} to {{ showDate($dateTo) }}</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
    <div class="invoice_info">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">{{ __('account.Date') }}</th>
                    <th scope="col">{{ __('account.Ref No.') }}</th>
                    <th scope="col">{{ __('account.Description') }}</th>
                    <th scope="col">{{ __('account.Debit') }}</th>
                    <th scope="col">{{ __('account.Credit') }}</th>
                    <th scope="col" class="text-right">{{ __('account.Balance') }}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $currentBalance = 0 + $balance + $opening_balance;
                @endphp
                <tr>
                    <td>{{ __('account.Openning Balance') }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right">{{ single_price($currentBalance) }}</td>
                </tr>
                @foreach ($transactions->sort() as $key => $payment)
                    @if ($payment->type != "Dr")
                        @php
                            $currentBalance -= $payment->amount;
                        @endphp
                    @else
                        @php
                            $currentBalance += $payment->amount;
                        @endphp
                    @endif
                    <tr>
                        <td>{{ showDate(@$payment->voucherable->date) }}</td>
                        <td>
                          <a onclick="voucher_detail({{ $payment->voucherable->id }})">{{ (@$payment->voucherable->referable->invoice_no) ? @$payment->voucherable->referable->invoice_no : @$payment->voucherable->tx_id }}</a>
                        </td>
                        <td>{{ @$payment->voucherable->narration }}</td>
                        <td>
                            @if ($payment->type == "Dr")
                                {{ single_price($payment->amount) }}
                                <input type="hidden" name="debit[]" value="{{ $payment->amount }}">
                            @endif
                        </td>
                        <td>
                            @if ($payment->type == "Cr")
                                {{ single_price($payment->amount) }}
                                <input type="hidden" name="credit[]" value="{{ $payment->amount }}">
                            @endif
                        </td>
                        <td class="text-right">{{ single_price($currentBalance) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td class="text-right">{{ single_price($currentBalance) }}</td>
                </tr>
            </tbody>
        </table>

    </div>
</div>

</body>
</html>
