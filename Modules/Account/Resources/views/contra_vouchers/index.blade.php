@extends('backEnd.master')
@section('mainContent')
    <section class="admin-visitor-area up_st_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('account.Contra Voucher') }}</h3>
                            <ul class="d-flex">
                                <li><a class="primary-btn radius_30px mr-10 fix-gr-bg" href="{{ route('contra.create') }}"><i class="ti-plus"></i>{{ __('common.Add New') }} {{ __('account.Contra Voucher') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table ">
                            <!-- table-responsive -->
                            <div class="">
                                <table class="table Crm_table_active3">
                                    <thead>
                                    <tr>
                                        <th scope="col">
                                            <label class="primary_checkbox d-flex ">
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </th>
                                        <th scope="col">{{ __('common.ID') }}</th>
                                        <th scope="col">{{ __('common.Name') }}</th>
                                        <th scope="col">{{ __('role.Details') }}</th>
                                        <th scope="col">{{ __('account.Approved') }}</th>
                                        <th scope="col">{{ __('common.Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($journals as $key => $journal)
                                        <tr>
                                            <th scope="col">
                                                <label class="primary_checkbox d-flex">
                                                    <input name="sms1" type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </th>
                                            <th>{{ $key+1 }}</th>
                                            <td>{{ $journal->tx_id }}</td>
                                            <td>{{ single_price($journal->amount) }}</td>
                                            <td>
                                                @if ($journal->is_approve == 0)
                                                    <span class="badge_3">Pending</span>
                                                @elseif ($journal->is_approve == 1)
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
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                                                        <a href="#" data-toggle="modal" class="dropdown-item" onclick="voucher_detail({{ $journal->id }})">{{__('account.View')}}</a>
                                                        @if ($journal->is_approve != 1)
                                                            <a href="{{ route('contra.edit', $journal->id) }}" data-toggle="modal" class="dropdown-item edit_brand">{{__('common.Edit')}}</a>
                                                            <a onclick="confirm_modal('{{route('vouchers.destroy', $journal->id)}}');" class="dropdown-item edit_brand">{{__('common.Delete')}}</a>
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
    <div id="Voucher_info">

    </div>
@include('backEnd.partials.delete_modal')
@endsection

@push("scripts")
    <script type="text/javascript">
        function voucher_detail(el){
            $.post('{{ route('get_voucher_details') }}', {_token:'{{ csrf_token() }}', id:el}, function(data){
                $('#Voucher_info').html(data);
                $('#Voucher_info_modal').modal('show');
                $('select').niceSelect();
            });
        }
    </script>
@endpush
