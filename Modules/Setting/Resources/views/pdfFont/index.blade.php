@extends('backEnd.master')
@section('mainContent')

    <section class="admin-visitor-area up_st_admin_visitor">

        @include('setting::pdfFont.components.create')
        @include('backEnd.partials.deleteModalAjaxRequest',['item_name' => trans('pdf.Font')])
        <div class="container-fluid p-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="box_header common_table_header">
                        <div class="main-title d-md-flex">
                            <h3 class="mb-0 mr-30 mb_xs_15px mb_sm_20px">{{ __('pdf.Font') }} {{ __('common.List')  }}</h3>
                            @if(permissionCheck('pdf_fonts.store'))
                                <ul class="d-flex">
                                    <li>
                                        <button class="primary-btn radius_30px mr-10 fix-gr-bg add_brand"><i
                                                    class="ti-plus"></i>{{ __('common.Add New') }}
                                        </button>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="QA_section QA_section_heading_custom check_box_table">
                        <div class="QA_table">
                            <div class="" id="item_table">
                                @include('setting::pdfFont.components.list')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        (function ($) {
            'use strict';
            let  btn_txt = '';
            $(document).on('change', ".imgBrowse", function () {
                var file = $(this).closest('.primary_file_uploader').find('.imgName');
                var filename = $(this).val().split('\\').pop();
                file.val(filename);
            });
            function submitterTextHide(el) {
                "use strict";

                let text = $('.submitting_text').val();
                let btn = '', type = '';
                btn = $(el).find('button[type="submit"]');
                btn_txt = btn.html();
                btn.attr('disabled', true);
                btn.text(text);
            }

            function submitterTextShow(el) {
                "use strict";

                let btn = '';
                btn = $(el).find('button[type="submit"]');
                btn.attr('disabled', false);
                btn.html(btn_txt);
            }
            $(document).ready(function () {

                $(document).on('submit','#item_create_form', function (event) {
                    event.preventDefault();
                    let selector = this;
                    submitterTextHide(selector);
                    var formData = new FormData(selector);
                    formData.append('_token', "{{ csrf_token() }}");
                    let url = "{{ route('pdf_fonts.store')}}";

                    $.ajax({
                        url: url,
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (response) {
                            submitterTextShow(selector);
                            if (response.success) {
                                toastr.success(response.success);
                                $('#item_add').modal('hide');
                                resetAfterChange(response.TableData);
                            } else {
                                toastr.error(response.error)
                            }
                        },
                        error: function (response) {
                            submitterTextShow(selector);
                            showValidationErrors('.item_create_form', response.responseJSON.errors);
                        }
                    });
                });
                $(document).on('submit','#deleteItemModal', function (event) {
                    event.preventDefault();
                    var formData = new FormData();
                    formData.append('_token', "{{ csrf_token() }}");
                    formData.append('id', $('#delete_item_id').val());
                    $.ajax({
                        url: "{{ route('pdf_fonts.destroy')}}",
                        type: "POST",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (response) {
                            if (response.success) {
                                toastr.success(response.success);
                                $('#deleteItemModal').modal('hide');
                                resetAfterChange(response.TableData);
                            } else {
                                toastr.error(response.error)
                            }
                        },
                        error: function (response) {
                            toastr.error('Something wrong !')
                        }
                    });
                });

                $(document).on('click', '.delete_brand', function () {
                    let item = $(this).data('item');
                    showDeleteModal(item.id);
                });
                $(document).on('click', '.add_brand', function () {
                    createModalShow();
                });
                $(document).on('change', '.status_change', function () {
                    update_active_status(this);
                });
            });

            function createModalShow() {
                $('#item_add').modal('show');
                $('#item_id').val('');
                $('#company_id').val('');
                $('.modal-title span').text('{{trans('common.Add New')}}');
                resetForm();
                $('#item_add select').niceSelect('update');
            }

            function showValidationErrors(formType, errors) {
                $(formType + ' #name_error').text(errors.name);
                $(formType + ' #font_file_error').text(errors.font_file);
            }

            function showDeleteModal(imteId) {
                if (app_sync == 1) {
                    toastr.error('{{ trans('common.app_sync') }}');
                } else {
                    $('#delete_item_id').val(imteId);
                    $('#deleteItemModal').modal('show');
                }
            }

            function editItem(item) {
                $('#item_add').modal('show');
                $('#item_id').val(item.id);
                $('.modal-title span').text('{{trans('common.Edit')}}');
                $("#font_file").val(item.font_file);
                $("#name").val(item.name);
                $('#item_add select').niceSelect('update');
            }

            function resetForm() {
                $('form')[0].reset();
                $('#name_error').text('');
                $('#font_file_error').text('');
                $('#font_file').val('');
                $('#bold_file').val('');
                $('#italic_file').val('');
                $('#name').val('');
                $('#id').val('');
                $('#item_add select').niceSelect('update');
            }

            function resetAfterChange(tableData) {
                $('#item_table').empty().html(tableData);
                CRMTableThreeReactive();
                resetForm();
            }

            function update_active_status(el) {

                if (el.checked) {
                    var status = 1;
                } else {
                    var status = 0;
                }

                $.post('{{ route('pdf_fonts.update_active_status')}}', {
                    _token: '{{ csrf_token() }}',
                    id: el.value,
                    status: status
                }, function (data) {
                    if (data.success) {
                        toastr.success(data.success);
                        resetAfterChange(data.TableData);

                        // window.location.reload();
                    } else {
                        toastr.error(data.error);
                    }
                });
            }
        })(jQuery)
    </script>
@endpush
