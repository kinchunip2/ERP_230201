<!DOCTYPE html>
<html>
<head>

    <title>Invoice</title>

    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
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

        .invoice_heading {
            border-bottom: 1px solid black;
            padding: 20px;
            text-transform: capitalize;
        }

        .invoice_logo {
            width: 33.33%;
            float: left;
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
        }

        .t-100 {
            min-height: 100px;
        }

        .billing_info {
            margin-top: 100px;
        }

        table {
            text-align: left;
            font-family: <?php echo $font_name ?>, sans-serif;
            font-weight: normal;
        }

        td, th {
            color: #828bb2;
            font-size: 10px;
            padding: 0;
            font-family: <?php echo $font_name ?>, sans-serif;
            font-weight: normal;
        }

        th {
            font-family: <?php echo $font_name ?>, sans-serif;
            font-weight: normal;
        }

        li {
            list-style-type: none;
            text-align: right;
        }

        .sale_note {
            width: 45%;
            float: left;
            text-align: left;
        }

        .notes {
            color: #415094;
            font-size: 18px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .note_details {
            font-size: 12px;
            font-weight: 600;
            color: #828BB2 !important;
        }

        .margin_120 {
            margin-top: 120px;
            font-size: 12px;
        }

        .margin_12 {
            margin-bottom: 120px;
            font-size: 12px;
        }

        .invoice_footer {
            position: absolute;
            left: 0;
            bottom: 180px;
            width: 100%;
        }

        .invoice_info_footer {
            padding: 0px;
            width: 100%;
            left: 0;
            text-transform: capitalize;
            position: inherit;
        }

        p {
            font-size: 10px;
            color: #454545;
            line-height: 16px;
        }

        .extra_div {
            height: 40px;
        }

        .a4_width {
            max-width: 1145.28px;
            margin: auto;
        }

        .nowrap {
            white-space: nowrap;
        }

        h5 {
            font-size: 13px !important;
            font-weight: 500;
            line-height: 12px;
        }

        .hpb-1 {
            padding: 0;
        }

        .width_custom {
            max-width: 200px;
        }
    </style>
</head>
<body>
@php
    $setting = app('general_setting');
@endphp

<div class="container-fluid">
    <div class="invoice_heading">
        <div class="invoice_logo">
            @if ($setting->logo)
                <img src="{{asset($setting->logo)}}" width="100px" alt="">
            @else
                <img src="{{asset('public/frontend/')}}/img/logo.png" width="100px" alt="">
            @endif

        </div>
        <div class="invoice_no">
            <h5 class="hpb-1">{{$setting->company_name}}</h5>
            <h5 class="hpb-1">{{$setting->phone}}</h5>
            <h5 class="hpb-1">{{$setting->email}}</h5>
            <h5>{{$setting->address}}</h5>
        </div>
    </div>

    <div class="invoice_info">
        <div class="invoice_logo" style="width:65%">
            <table class="table-borderless">
                <tr>
                    <td>{{__('common.Bill No')}}</td>
                    <td>: {{$data->invoice_no}}</td>
                </tr>
                <tr>
                    <td>{{__('common.Bill Date')}}</td>
                    <td>: {{ showDate($data->created_at) }}</td>
                </tr>
                <tr>
                    <td>{{__('common.Party Name')}}</td>
                    <td>: {{@$data->supplier->name}}</td>
                </tr>
                <tr>
                    <td>{{__('common.Party Address')}}</td>
                    <td>: {{@$data->supplier->address}}</td>
                </tr>
                <tr>
                    <td>{{__('common.Phone')}}</td>
                    <td>: {{@$mobile}}</td>
                </tr>
                <tr>
                    <td>{{__('common.Email')}}</td>
                    <td>: {{@$email}}</td>
                </tr>
            </table>
        </div>
        <div class="invoice_logo" style="width:35%">
            <table class="table-borderless mr_0 ml_auto">
                <tr>
                    <td>{{__('common.Served By')}}</td>
                    <td>: {{$data->user->name}}</td>
                </tr>
                <tr>
                    <td>{{__('common.Entry Time')}}</td>
                    <td>: {{date('m-d-Y H:i:s', strtotime($data->created_at))}}</td>
                </tr>
                <tr>
                    <td>{{__('sale.Ref. No')}}</td>
                    <td>: {{$data->ref_no}}</td>
                </tr>
                <tr>
                    <td>{{__('common.Status')}}</td>
                    <td>: {{$data->is_paid == 2 ? trans('sale.Paid') : trans('sale.Unpaid')}}</td>
                </tr>
                <tr>
                    <td>{{__('sale.Branch')}}</td>
                    <td>: {{@$data->purchasable->name}}</td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="invoice_info">
        <table class="table table-bordered billing_info" style="width: 100%;">
            <tr class="m-0">
                <th>{{__('quotation.Product Name')}}</th>
                @if (app('general_setting')->origin == 1)
                    <th>{{__('common.Part Number')}}</th>
                @endif
                <th>{{__('product.Brand')}}</th>
                <th>{{__('product.Model')}}</th>
                <th>{{__('quotation.Price')}}</th>
                <th>{{__('quotation.Quantity')}}</th>
                <th>{{__('quotation.Tax')}}</th>
                <th>{{__('quotation.Discount')}} (%)</th>
                <th style="width:15%; text-align: right; padding-left:0">{{__('quotation.SubTotal')}}</th>
            </tr>

            @foreach($data->items as $item)
                @php
                    $v_name = [];
                    $v_value = [];
                    $variantName = null;
                    if ($item->productSku->product_variation) {
                        foreach (json_decode($item->productSku->product_variation->variant_id) as $key => $value) {
                            array_push($v_name , Modules\Product\Entities\Variant::find($value)->name);
                        }
                        foreach (json_decode($item->productSku->product_variation->variant_value_id) as $key => $value) {
                            array_push($v_value , Modules\Product\Entities\VariantValues::find($value)->value);
                        }

                        for ($i=0; $i < count($v_name); $i++) {
                            $variantName .= $v_name[$i] . ' : ' . $v_value[$i];
                        }
                    }
                @endphp
                <tr>
                    <td class="p-2">{{@$item->productSku->product->product_name}}<br>
                        @if ($variantName)
                            ({{ $variantName }})
                        @endif
                    </td>
                    @if (app('general_setting')->origin == 1)
                        <td>{{@$item->productable->product->origin}}</td>
                    @endif
                    <td>{{@$item->productSku->product->brand->name}}</td>
                    <td>{{@$item->productSku->product->model->name}}</td>
                    <td class="p-2">{{@$item->price}}</td>
                    <td class="p-2">{{@$item->quantity}}</td>
                    <td class="p-2">{{@$item->tax}}</td>
                    <td class="p-2">{{@$item->discount}}</td>
                    <td class="p-2" style="text-align: right">{{@$item->sub_total}}</td>
                </tr>
            @endforeach
            <tfoot>
            @php
                $subtotal = $data->items->sum('price') * $data->items->sum('quantity');
                $tax = ($subtotal * $data->items->sum('tax'))/100;
                if ($data->discount_type == 2)
                    $discount = ($data->amount * $data->total_discount) / 100;
                else
                    $discount = $data->total_discount;
                $vat =($data->amount * $data->total_vat) / 100
            @endphp
            @php
                $paid =0
            @endphp
            <tr >
                <td @if (app('general_setting')->origin == 1) colspan="8" @else colspan="7" @endif style="text-align: right;">

                        <p>{{__('quotation.SubTotal')}} :</p>
                        @if($data->items->sum('discount') > 0)
                            <p>{{__('sale.Product Wise Discount')}} :</p>
                        @endif
                        @if($tax > 0)
                            <p>{{__('sale.Product Wise Tax')}} :</p>
                        @endif
                        @if($vat > 0)
                            <p>{{__('purchase.Order Tax')}} :</p>
                        @endif
                        @if($discount > 0)
                            <p>{{__('purchase.Order Discount')}} :</p>
                        @endif
                        @if($data->shipping_charge > 0)
                            <p>{{__('purchase.Shipping Charge')}} :</p>
                        @endif
                        @if($data->other_charge > 0)
                            <p>{{__('purchase.Other Charge')}} :</p>
                        @endif
                        <p>{{__('sale.Total Amount')}} :</p>
                        @if($data->payable_amount - $paid > 0)
                            <p>{{__('sale.Total Due')}} :</p>
                        @endif

                </td>
                @php
                    $paid = $data->payments->sum('amount')
                @endphp
                <td style="padding-left:0; text-align: right;">

                        <p style="white-space:nowrap;">{{single_price_pdf($data->amount)}}</p>
                        @if($data->items->sum('discount') > 0)
                            <p style="white-space:nowrap;">{{single_price_pdf($data->items->sum('discount'))}}</p>
                        @endif
                        @if($tax > 0)
                            <p style="white-space:nowrap;">{{single_price_pdf($tax)}}</p>
                        @endif
                        @if($vat > 0)
                            <p style="white-space:nowrap;">{{single_price_pdf($vat)}}</p>
                        @endif
                        @if($discount > 0)
                            <p style="white-space:nowrap;">{{single_price_pdf($discount)}}</p>
                        @endif
                        @if($data->shipping_charge > 0)
                            <p style="white-space:nowrap;">{{single_price_pdf($data->shipping_charge)}}</p>
                        @endif
                        @if($data->other_charge > 0)
                            <p style="white-space:nowrap;">{{single_price_pdf($data->other_charge)}}</p>
                        @endif
                        <p style="white-space:nowrap;">{{single_price_pdf($data->payable_amount)}}</p>
                        @if($data->payable_amount - $paid > 0)
                            <p style="white-space:nowrap;">{{single_price_pdf($data->payable_amount - $paid)}}</p>
                        @endif
                </td>
            </tr>
            </tfoot>
        </table>
    </div>

    @if ($data->notes)
        <div class="invoice_info margin_12 custom_margin"
             style="display: flex;justify-content: space-between; width:100%;">
            <div class="sale_note" style="">
                <div class="sale_note_inner text-justify">

                    <h3 class="notes">{{__('common.Note')}}</h3>
                    <div class="note_details">{!! $data->notes !!}</div>

                </div>
            </div>

        </div>
    @endif
</div>


<footer class="invoice_footer">
    <div class="invoice_info_footer">
        <div class="invoice_logo text-center">
            <img src="{{ asset('public/frontend/img/signature.png') }}" alt="">
            <p style="margin-bottom:5px">--------------------------</p>
            <p style="margin:0; line-height:14px;">{{__('contact.Supplier')}} {{__('sale.Signature')}}</p>
        </div>
        <div class="invoice_logo text-center">
            <img
                src="{{ $data->user->signature ? asset($data->user->signature) : asset('public/frontend/img/signature.png') }}"
                alt="">
            <p style="margin-bottom:5px">--------------------------</p>
            <p style="margin:0; line-height:14px;">{{__('sale.Accountant')}} {{__('sale.Signature')}}</p>
        </div>
        <div class="invoice_logo text-center">
            <img
                src="{{  $data->updater->signature ? asset($data->updater->signature) : asset('public/frontend/img/signature.png') }}"
                alt="">
            <p style="margin-bottom:5px">--------------------------</p>
            <p style="margin:0; line-height:14px;">{{__('sale.Authorized')}} {{__('sale.Signature')}}</p>
        </div>
    </div>
</footer>
</body>
</html>
