<div class="modal fade admin-query" id="Apply_Leave_Edit">
    <div class="modal-dialog modal_800px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('leave.Apply Leave Details') }}</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="">{{ __('leave.Type') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.Staff') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.Joining Date') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.Email') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.From') }}:</label>
                            @if($apply_leave->end_date && $apply_leave->end_date != '0000-00-00')
                                <label class="primary_input_label" for="">{{ __('leave.To') }}:</label>
                            @endif
                            <label class="primary_input_label" for="">{{ __('leave.Apply Date') }}:</label>
                            <label class="primary_input_label" for="">{{ __('common.Status') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.Approved By') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.Reason') }}:</label>
                            @if($apply_leave->attachment != Null)
                            <label class="primary_input_label" for="">{{ __('leave.Attachment') }}:</label>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="">{{ $apply_leave->leave_type->name }}.</label>
                            <label class="primary_input_label" for="">{{ $apply_leave->user->name }}.</label>
                            <label class="primary_input_label"
                                   for="">{{ dateConvert($apply_leave->user->created_at) }}.</label>
                            <label class="primary_input_label" for="">{{ $apply_leave->user->email }}.</label>
                            <label class="primary_input_label"
                                   for="">{{ dateConvert($apply_leave->start_date) }}. ({{ $apply_leave->leave_from == 1 ? trans('leave.First Half') : trans('leave.Second Half') }})</label>
                            @if($apply_leave->end_date && $apply_leave->end_date != '0000-00-00')
                                <label class="primary_input_label"
                                       for="">{{ dateConvert($apply_leave->end_date) }}.</label>
                            @endif
                            <label class="primary_input_label"
                                   for="">{{ dateConvert($apply_leave->apply_date) }}.</label>
                            @if ($apply_leave->status == 0)
                                <span class="pending">{{__('leave.Pending')}}</span>
                            @elseif ($apply_leave->status == 1)
                                <span class="pending">{{__('leave.Approved')}}</span>
                            @else
                                <span class="pending">{{__('leave.Cancelled')}}</span>
                            @endif
                            @if($apply_leave->approved_by)
                                <label class="primary_input_label" for="">{{ $apply_leave->approveUser->name }}.</label>
                            @else 
                            <label class="primary_input_label" for="">..</label>    
                            @endif
                            <label class="primary_input_label" for="">{{ $apply_leave->reason }}.</label>
                            @if($apply_leave->attachment != Null)
                               <label class="primary_input_label" for=""><a href="{{ asset($apply_leave->attachment) }}"
                                                                         download
                                                                         target="_blank">@if ($apply_leave->attachment != Null) {{ __('leave.See Attachment') }} @else {{ __('leave.Not Available') }} @endif</a>.</label>
                            @endif                                             
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="">{{ __('common.Date of Joining') }}:</label>
                            <label class="primary_input_label" for="">{{ __('common.Employment Type') }}:</label>
                            <label class="primary_input_label" for="">{{ __('common.Last Date Of Provisional Period') }}
                                :</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label"
                                   for="">{{ dateConvert($apply_leave->user->staff->date_of_joining) }}
                                .</label>
                            <label class="primary_input_label" for="">{{ $apply_leave->user->staff->employment_type }}
                                .</label>
                            <label class="primary_input_label"
                                   for="">{{ dateConvert(\Carbon\Carbon::now()->addMonths($apply_leave->user->staff->provisional_months)) }}
                                .</label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label" for="">{{ __('leave.Total Leave') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.Remaining Total Leave') }}:</label>
                            <label class="primary_input_label" for="">{{ __('leave.Extra Taken Leave') }}:</label>
                        </div>
                    </div>
                    @php
                        $remaining_leave_days = 0;
                        $extra_leave_days =  0;
                        if ($total_leave->sum('total_days') > $apply_leave_histories->sum('total_days')) {
                            $remaining_leave_days = $total_leave->sum('total_days') - $apply_leave_histories->sum('total_days');
                        }else {
                            $extra_leave_days =  $apply_leave_histories->sum('total_days') - $total_leave->sum('total_days');
                        }
                    @endphp
                    <div class="col">
                        <div class="primary_input mb-25">
                            <label class="primary_input_label"
                                   for="">{{ $total_leave->sum('total_days') }} {{__('leave.Days')}}</label>
                            <label class="primary_input_label" for="">{{ $remaining_leave_days }} {{__('leave.Days')}}
                                .</label>
                            <label class="primary_input_label" for="">{{ $extra_leave_days }} {{__('leave.Days')}}
                                .</label>
                        </div>
                    </div>
                </div>
                @if ($apply_leave->status != 1 && $view != 1)
                    <hr>
                    <div class="row">
                        <input type="hidden" name="apply_leave_id" id="apply_leave_id" value="{{ $apply_leave->id }}">
                        <div class="col-xl-9 mt-2">
                            <button type="submit" class="primary-btn btn-sm fix-gr-bg" data-dismiss="modal"><i
                                    class="ti-close"></i>{{ __('common.Cancel') }}</button>
                        </div>
                        @if(canApprove($apply_leave->user->staff->id))
                            <div class="col-xl-3">
                                <div class="primary_input mb-15">
                                    <select class="primary_select mb-15" name="status" id="status" required>
                                        <option>{{ __('common.Select one') }}</option>
                                        <option value="1"
                                                @if ($apply_leave->status == 1) selected @endif>{{ __('common.Approve') }}</option>
                                        <option value="0"
                                                @if ($apply_leave->status == 0) selected @endif>{{ __('common.Pending') }}</option>
                                        <option value="2"
                                                @if ($apply_leave->status == 2) selected @endif>{{ __('common.Cancel') }}</option>
                                    </select>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- <div class="modal-body detail_view">
                <div class="row">
                    <div class="col-xl-6">
                        <h4>{{ $apply_leave->user != null ? $apply_leave->user->name : "Removed" }}
                            - {{ @$apply_leave->department->name }} {{__('organization.Department')}}</h4>
                        <p>{{ @$apply_leave->user->staff->designation->name }}</p>
                    </div>
                    <div class="col-lg-6 text-right">
                        <img src="{{ asset($apply_leave->user && $apply_leave->user->avatar ? $apply_leave->user->avatar : "public/backEnd/img/user.png") }}"
                             id="view_common_image" alt="user.png" width="100">
                    </div>
                    <div class="col-lg-12">
                        <table class="table table-borderless">
                            <tr class="border-bottom">
                                <td class="text-muted left_text">{{ __('leave.Leave Type') }}</td>
                                <td>:</td>
                                <td> {{ @$apply_leave->leave_type->name }}</td>
                                <td class="text-muted left_text">{{ __('leave.Apply Date') }}</td>
                                <td>:</td>
                                <td> {{ dateConvert($apply_leave->apply_date) }}</td>
                            </tr>
                            <tr class="border-bottom">
                                <td class="text-muted left_text">{{ __('leave.Day') }}</td>
                                <td>:</td>
                                <td> {{ $apply_leave->day == 2 ? trans('leave.Multiple Day') : ($apply_leave->day == 1 ? trans('leave.Single Day') : trans('leave.Half Day')) }}
                                    @if ($apply_leave->day == 0)
                                        <span>({{ $apply_leave->leave_from == 1 ? trans('leave.First Half') : trans('leave.Second Half') }})</span>
                                    @endif
                                </td>
                                <td class="text-muted left_text">{{ __('leave.Total Days') }}</td>
                                <td>:</td>
                                <td> {{ @$apply_leave->total_days }}</td>
                            </tr>

                            <tr class="border-bottom">
                                <td class="text-muted left_text">{{ $apply_leave->day == 2 ? __('leave.From') : trans('common.Date') }}</td>
                                <td>:</td>
                                <td> {{ dateConvert($apply_leave->start_date) }}
                                    @if ($apply_leave->day == 2)
                                        <span>({{ $apply_leave->leave_from == 1 ? trans('leave.First Half') : trans('leave.Second Half') }})</span>
                                    @endif
                                </td>
                                @if ($apply_leave->day == 2)
                                    <td class="text-muted left_text">{{ $apply_leave->day == 2 ? __('leave.To') : '' }}</td>
                                    <td>{{ $apply_leave->day == 2 ? ':' : '' }}</td>
                                    <td> {{ $apply_leave->end_date && $apply_leave->end_date != '0000-00-00' ? dateConvert($apply_leave->end_date) : ''}}
                                        @if ($apply_leave->day == 2)
                                            <span>({{ $apply_leave->leave_to == 1 ? trans('leave.First Half') : trans('leave.Second Half') }})</span>
                                        @endif
                                    </td>
                                @endif

                            </tr>

                            <tr class="border-bottom">
                                <td class="text-muted left_text">{{ __('common.Status') }}</td>
                                <td>:</td>
                                <td> @if ($apply_leave->status == 0)
                                        {{__('leave.Pending')}}
                                    @elseif ($apply_leave->status == 1)
                                        {{__('leave.Approved')}}
                                    @else
                                        {{__('leave.Cancelled')}}
                                    @endif
                                </td>
                                <td class="text-muted left_text">{{ __('leave.Approved By') }}</td>
                                <td>:</td>
                                <td> @if($apply_leave->approved_by)
                                        {{ @$apply_leave->approveUser->name }}
                                    @endif
                                </td>
                            </tr>
                            <tr class="border-bottom">
                                <td class="text-muted left_text">{{__('leave.Reason')}}</td>
                                <td>:</td>
                                <td> {{ $apply_leave->reason }}</td>
                                <td class="text-muted left_text">{{ __('leave.Attachment') }}</td>
                                <td>:</td>
                                <td>
                                    @if ($apply_leave->attachment)
                                        <a href="{{ asset($apply_leave->attachment) }}">{{ __('leave.See Attachment') }}</a>
                                    @else
                                        {{ __('leave.Not Available') }}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    @if ($apply_leave->status != 1 && permissionCheck('pending_index'))
                        <div class="col-lg-12 mt-30 approval_area displayNone">
                            <form action="{{ route('set_approval_leave') }}" method="post">@csrf
                                <div class="row">
                                    <input type="hidden" name="apply_leave_id" value="{{ $apply_leave->id }}">
                                    <div class="col-xl-12">
                                        <div class="primary_input">
                                            <label class="primary_input_label" for="">{{ __('common.Status') }}</label>
                                            <ul id="theme_nav" class="permission_list sms_list ">
                                                <li>
                                                    <label data-id="bg_option"
                                                           class="primary_checkbox d-flex mr-12">
                                                        <input name="status" id="status_active" value="1"
                                                               {{ isset($apply_leave) && $apply_leave->status == 1 ? 'checked' : '' }} class="active"
                                                               type="radio">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <p>{{ __('common.Approve') }}</p>
                                                </li>
                                                <li>
                                                    <label data-id="color_option"
                                                           class="primary_checkbox d-flex mr-12">
                                                        <input name="status" value="0" id="status_inactive"
                                                               {{ isset($apply_leave) && $apply_leave->status == 0 ? 'checked' : '' }} class="de_active"
                                                               type="radio">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <p>{{ __('common.Pending') }}</p>
                                                </li>
                                                <li>
                                                    <label data-id="color_option"
                                                           class="primary_checkbox d-flex mr-12">
                                                        <input name="status" value="2"
                                                               {{ isset($apply_leave) && $apply_leave->status == 2 ? 'checked' : '' }} class="de_active"
                                                               type="radio">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <p>{{ __('common.Cancel') }}</p>
                                                </li>
                                            </ul>
                                            <span class="text-danger" id="status_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 text-center mt-2">
                                        <button type="submit" class="primary-btn btn-sm fix-gr-bg"><i
                                                    class="ti-save"></i>{{ __('common.Save') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div> -->
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#status").change(function () {
            var apply_leave_id = $('#apply_leave_id').val();
            var status = $('#status').val();
            $.post('{{ route('set_approval_leave') }}', {
                _token: '{{ csrf_token() }}',
                id: apply_leave_id,
                status: status
            }, function (data) {
                if (data.success) {
                    toastr.success(data.success);
                    location.reload();
                } else {
                    toastr.error(data.error);
                }
            });
        });
    });
</script>
