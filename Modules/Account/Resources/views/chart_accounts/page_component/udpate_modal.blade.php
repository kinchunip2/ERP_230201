{{-- update modal --}}
<div class="modal fade admin-query" id="ChartAccount_Edit">
    <div class="modal-dialog modal_800px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('account.Edit Account Info') }}</h4>
                <button type="button" class="close " data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>

            <div class="modal-body">
                <form action="" id="ChartAccountEditForm">
                    <div class="row">
                        <input type="text" style="display: none;" class="edit_id">
                        <div class="col-xl-12">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label"
                                       for="">{{ __('common.Name') }}</label>
                                <input name="name" class="primary_input_field name" placeholder="{{ __('common.Name') }}" type="text" required>
                                <span class="text-danger" id="edit_name_error"></span>
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label" for="">{{ __('common.Description') }}</label>
                                <input name="description" class="primary_input_field description"  placeholder="{{ __('common.Description') }}" type="text">
                                <span class="text-danger" id="edit_description_error"></span>
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <div class="primary_input">
                                <label class="primary_input_label" for="">{{ __('common.Status') }}</label>
                                <ul id="theme_nav" class="permission_list sms_list ">
                                    <li>
                                        <label data-id="bg_option" class="primary_checkbox d-flex mr-12">
                                            <input name="status" value="1" class="active" type="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{__('common.Active')}}</p>
                                    </li>
                                    <li>
                                        <label data-id="color_option" class="primary_checkbox d-flex mr-12">
                                            <input name="status" value="0" class="de_active" type="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                        <p>{{__('common.DeActive')}}</p>
                                    </li>
                                </ul>
                                <span class="text-danger" id="edit_status_error"></span>
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <div class="primary_input mb-25">
                                <label class="primary_input_label"
                                       for="">{{ __('account.Add as Sub Account') }}</label>
                                <label data-id="color_option"
                                       class="primary_checkbox d-flex mr-12">
                                    <input name="as_sub_category" value="1" class="as_sub_category_edit" type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-xl-12 edit_parent_chartAccount" style="display: none;">
                            <div class="primary_input mb-15">
                                <label class="primary_input_label"
                                       for="">{{ __('account.Select parent Account') }}</label>
                                <div id="edit_parent_chartAccount_list"></div>
                            </div>
                        </div>


                        <div class="col-lg-12 text-center">
                            <div class="d-flex justify-content-center pt_20">
                                <button type="submit" class="primary-btn semi_large2  fix-gr-bg"
                                        id="save_button_parent"><i class="ti-check"></i>{{ __('common.Update') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
