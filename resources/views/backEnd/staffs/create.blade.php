@extends('backEnd.master')
@section('mainContent')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex">
                        <h3 class="mb-0 mr-30">{{ __('common.Add New') }} {{ __('common.Staff') }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="white_box_50px box_shadow_white">
                    <form action="{{ route('staffs.store') }}" method="POST" id="staff_addForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="main-title d-flex">
                                    <h3 class="mb-0 mr-30">{{ __('common.Basic Info') }}</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('role.Role') }} *</label>
                                    <select class="primary_select mb-25" name="role_id" id="role_id" >
                                        <option disabled selected>{{ __('common.Select One') }}</option>
                                        @foreach (\Modules\RolePermission\Entities\Role::where('type', '!=', 'normal_user')->get()->except(1) as $key => $role)
                                            <option value="{{ $role->id }}-{{ $role->type }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{$errors->first('role_id')}}</span>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Name') }} *</label>
                                    <input name="name" class="primary_input_field name" placeholder="{{ __('common.Name') }}" type="text" value="{{old('name')}}">
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Email') }} *</label>
                                    <input name="email" class="primary_input_field name" placeholder="{{ __('common.Email') }}" type="email" value="{{old('email')}}">
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('retailer.Phone') }}</label>
                                    <input type="number" class="primary_input_field user_id name" placeholder="{{ __('common.Phone') }}" name="username"
                                           value="{{old('username')}}">
                                    <span class="text-danger">{{$errors->first('username')}}</span>
                                </div>
                            </div>



                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Password') }} ({{trans('common.Minimum 8 Letter')}}) *</label>
                                    <input name="password" class="primary_input_field name" placeholder="{{ __('common.Password') }}" type="password" minlength="6">
                                    <span class="text-danger">{{$errors->first('password')}}</span>
                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('department.Department') }} *</label>
                                    <select class="primary_select mb-25" name="department_id" id="department_id">
                                        @foreach (\Modules\Setup\Entities\Department::all() as $key => $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{$errors->first('department_id')}}</span>
                                </div>
                            </div>

                            <div class="col-xl-4 mt-10">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('inventory.Warehouse') }}</label>
                                    <select class="primary_select mb-25" name="warehouse_id" id="warehouse_id">
                                        @foreach (\Modules\Inventory\Entities\WareHouse::all() as $key => $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{$errors->first('warehouse_id')}}</span>
                                </div>
                            </div>

                            <div class="col-xl-4 mt-10">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('showroom.Branch') }} *</label>
                                    <select class="primary_select mb-25" name="showroom_id" id="showroom_id">
                                        @foreach (\Modules\Inventory\Entities\ShowRoom::where('status', 1)->get() as $key => $showroom)
                                            <option value="{{ $showroom->id }}">{{ $showroom->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">{{$errors->first('showroom_id')}}</span>
                                </div>
                            </div>
                            <div class="col-xl-4 date_of_birth_div">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">{{ __('common.Date of Birth') }} </label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="{{ __('common.Date of Birth') }}" class="primary_input_field primary-input date form-control" id="date_of_birth" type="text"
                                                           name="date_of_birth" value="" autocomplete="off">
                                                </div>
                                            </div>
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{$errors->first('date_of_birth')}}</span>
                                </div>
                            </div>

                            <div class="col-xl-4 current_address_div">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Current Address') }}</label>
                                    <input name="current_address" id="current_address" class="primary_input_field name" placeholder="{{ __('common.Current Address') }}" type="text" value="{{old('current_address')}}">
                                    <span class="text-danger">{{$errors->first('current_address')}}</span>
                                    <span class="text-danger">{{$errors->first('current_address')}}</span>
                                </div>
                            </div>

                            <div class="col-xl-4 permanent_address_div">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Permanent Address') }}</label>
                                    <input name="permanent_address" id="permanent_address" class="primary_input_field name" placeholder="{{ __('common.Permanent Address') }}" type="text" value="{{old('permanent_address')}}">
                                    <span class="text-danger">{{$errors->first('permanent_address')}}</span>
                                </div>
                            </div>

                            <div class="col-lg-4 opening_balance_div">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">{{__('common.Opening Balance')}}</label>
                                    <input type="number" min="0" step="0.01" name="opening_balance" class="primary_input_field"
                                           value="{{old('opening_balance')}}">
                                    <span class="text-danger">{{$errors->first('opening_balance')}}</span>
                                </div>
                            </div>
                            <input type="hidden" name="role_type" id="role_type" value="">
                            <div class="col-lg-4">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">{{ __('common.Profile Picture') }}</label>
                                    <div class="primary_file_uploader">
                                        <input class="primary-input" type="text" id="placeholderFileOneName"
                                               placeholder="{{ __('common.Browse File') }}" readonly="">
                                        <button class="" type="button">
                                            <label class="primary-btn small fix-gr-bg"
                                                   for="document_file_1">{{ __('common.Browse') }}</label>
                                            <input type="file" class="d-none" name="photo" id="document_file_1">
                                        </button>
                                    </div>
                                    <span class="text-danger">{{$errors->first('photo')}}</span>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">{{ __('leave.Applicable For Leave') }} *</label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="Date" class="primary_input_field primary-input date form-control" type="text" name="leave_applicable_date"
                                                           value="{{date('m/d/Y')}}" autocomplete="off">
                                                </div>
                                            </div>
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{$errors->first('leave_applicable_date')}}</span>
                                </div>
                            </div>


                            <div class="col-xl-4">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">{{ __('common.Signature') }}</label>
                                    <div class="primary_file_uploader">
                                        <input class="primary-input" type="text" id="placeholderFileOneName" placeholder="{{ __('common.Browse File') }}" readonly="">
                                        <button class="" type="button">
                                            <label class="primary-btn small fix-gr-bg" for="document_file_2">{{ __('common.Browse') }}</label>
                                            <input type="file" class="d-none" name="signature_photo" id="document_file_2">
                                        </button>
                                    </div>
                                    <span class="text-danger">{{$errors->first('photo')}}</span>


                                </div>
                            </div>

                            <div class="col-xl-12 mt-5 bank_info_div">
                                <div class="main-title d-flex">
                                    <h3 class="mb-0 mr-30">{{ __('common.Bank Info') }}</h3>
                                </div>
                            </div>
                            <hr>
                            <div class="col-xl-6 bank_name_div">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Bank Name') }}</label>
                                    <input name="bank_name" id="bank_name" class="primary_input_field name" value="{{old('bank_name')}}" placeholder="{{ __('common.Bank Name') }}" type="text">
                                    <span class="text-danger">{{$errors->first('bank_name')}}</span>
                                </div>
                            </div>

                            <div class="col-xl-6 bank_account_name_div">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Branch Name') }}</label>
                                    <input name="bank_branch_name" value="{{old('bank_branch_name')}}" id="bank_branch_name" class="primary_input_field name" placeholder="{{ __('common.Branch Name') }}" type="text">
                                    <span class="text-danger">{{$errors->first('bank_branch_name')}}</span>
                                </div>
                            </div>

                            <div class="col-xl-6 bank_account_no_div">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Account Name') }}</label>
                                    <input name="bank_account_name" value="{{old('bank_account_name')}}" id="bank_account_name" class="primary_input_field name" placeholder="{{ __('common.Account Name') }}" type="text">
                                    <span class="text-danger">{{$errors->first('bank_account_name')}}</span>
                                </div>
                            </div>

                            <div class="col-xl-6 payroll_info_div">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Account Number') }}</label>
                                    <input name="bank_account_no" value="{{old('bank_account_no')}}" id="bank_account_no" class="primary_input_field name" placeholder="{{ __('common.Account Number') }}" type="text">
                                    <span class="text-danger">{{$errors->first('bank_account_no')}}</span>
                                </div>
                            </div>

                            <hr>

                            <div class="col-xl-12 mt-5 payroll_info_div">
                                <div class="main-title d-flex">
                                    <h3 class="mb-0 mr-30">{{ __('common.Payroll Info') }}</h3>
                                </div>
                            </div>
                            <hr>

                            <div class="col-xl-6 date_of_joining_div">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">{{ __('common.Date of Joining') }} *</label>
                                    <div class="primary_datepicker_input">
                                        <div class="no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="">
                                                    <input placeholder="Date" class="primary_input_field primary-input date form-control" id="date_of_joining" type="text" name="date_of_joining" value="{{date('m/d/Y')}}" autocomplete="off">
                                                </div>
                                            </div>
                                            <button class="" type="button">
                                                <i class="ti-calendar" id="start-date-icon"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger">{{$errors->first('date_of_joining')}}</span>
                                </div>
                            </div>
                            <div class="col-xl-6 basic_salary_div">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Basic Salary') }} *</label>
                                    <input name="basic_salary" value="{{old('basic_salary')}}" id="basic_salary" class="primary_input_field name" placeholder="{{ __('common.Basic Salary') }}" type="number">
                                    <span class="text-danger">{{$errors->first('basic_salary')}}</span>
                                </div>
                            </div>

                            <div class="col-xl-6 employee_type_div">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Employment Type') }} *</label>
                                    <select class="primary_select mb-25" name="employment_type" id="employment_type" onchange="getField()">
                                        <option value="">{{ __('common.Select One') }}</option>
                                        <option value="Provision">{{ __('common.Provision') }}</option>
                                        <option value="Contract">{{ __('common.Contract') }}</option>
                                        <option value="Permanent">{{ __('common.Permanent') }}</option>
                                        <option value="Parttime">{{ __('common.Parttime') }}</option>
                                    </select>
                                    <span class="text-danger">{{$errors->first('employment_type')}}</span>
                                </div>
                            </div>
                            <div class="col-xl-6 provisional_time_div">
                                <div class="primary_input mb-25">
                                    <label class="primary_input_label" for="">{{ __('common.Provision Time') }} <small>({{ __('common.In Months') }})</small> </label>
                                    <input name="provisional_months" value="{{old('provisional_months')}}" id="provisional_time" class="primary_input_field name" placeholder="0" type="number">
                                    <span class="text-danger">{{$errors->first('provisional_months')}}</span>
                                </div>
                            </div>

                            <div class="col-lg-12 text-center">
                                <div class="d-flex justify-content-center pt_20">
                                    <button type="submit" class="primary-btn semi_large2 fix-gr-bg" id="save_button_parent"><i class="ti-check"></i>{{ __('common.Save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('scripts')
<script type="text/javascript">
    function getField()
    {
        var employment_type = $('#employment_type').val();
        if (employment_type == "Provision") {
            $("#provisional_time").removeAttr("disabled");
        }
        else if (employment_type == "Contract") {
            $("#provisional_time").attr('disabled', true);
        }
        else {
            $("#bank_name").attr('Permanent', true);
            $("#provisional_time").attr('disabled', true);
        }
    }

</script>
@endpush
