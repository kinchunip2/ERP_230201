@extends('backEnd.master')
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">
                        <div class="row">
                            <div class="col-12">
                                <div class="box_header">
                                    <div class="main-title">
                                        <h3 class="mb-0" >{{__('contact.Customer Invoice')}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="QA_section QA_section_heading_custom check_box_table">
                                    <div class="QA_table ">
                                        <!-- table-responsive -->
                                        <div class="">
                                            <table class="table Crm_table_active">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">{{__('sale.Date')}}</th>
                                                        <th scope="col">{{__('sale.Invoice')}}</th>
                                                        <th scope="col">{{__('sale.Reference No')}}</th>
                                                        <th scope="col">{{__('common.Sold By')}}</th>
                                                        <th scope="col">{{__('common.Paid Status')}}</th>
                                                        <th scope="col">{{__('common.Amount')}}</th>
                                                        <th scope="col">{{ __('common.Action') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $total = 0;
                                                    @endphp
                                                    @foreach ($customer->sales as $key => $sale)
                                                    @php
                                                        $total += $sale->amount;
                                                    @endphp
                                                        <tr>
                                                            <td>{{ showDate($sale->created_at) }}</td>
                                                            <td><a onclick="getDetails({{ $sale->id }})">{{$sale->invoice_no}}</a></td>
                                                            <td>{{$sale->ref_no}}</td>
                                                            <td>{{@$sale->user->name}}</td>

                                                            <td>
                                                                @if ($sale->status == 0)
                                                                    <h6><span class="badge_4">{{__('sale.Unpaid')}}</span></h6>
                                                                @elseif ($sale->status == 2)
                                                                    <h6><span class="badge_4">{{__('sale.Partial')}}</span></h6>
                                                                @else
                                                                    <h6><span class="badge_1">{{__('sale.Paid')}}</span></h6>
                                                                @endif
                                                            </td>
                                                            <td>{{$sale->amount}}</td>
                                                            <td>
                                                                <div class="dropdown CRM_dropdown">
                                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                                            id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false"> {{__('common.select')}}
                                                                    </button>
                                                                    <div class="dropdown-menu dropdown-menu-right"
                                                                         aria-labelledby="dropdownMenu2">

                                                                        @if ($sale->status != 1)
                                                                            <a href="{{route('contact.my_payment',$sale->id)}}" class="dropdown-item"
                                                                               type="button">{{__('pos.Payment')}}</a>
                                                                        @endif

                                                                        <a href="{{route('sale.pdf',$sale->id)}}" class="dropdown-item" type="button">{{__('quotation.Download')}}</a>

                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <td ></td>
                                                    <td ></td>
                                                    <td ></td>
                                                    <td ></td>
                                                    <td >{{ __('common.Total') }}</td >
                                                    <td >{{ $total }}</td>
                                                    <td ></td >
                                                </tr>
                                                </tfoot>
                                            </table>
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


@endsection
@push('scripts')

@endpush
