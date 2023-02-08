<form enctype="multipart/form-data" id="{{ $form_id }}">
    <div class="row">

        <input type="hidden" name="id" id="item_id">
        <div class="col-xl-6">
            <div class="primary_input">
                <label class="primary_input_label" for="">{{ __('common.Name') }} *</label>
                <input type="text" name="name" class="primary_input_field" id="name" placeholder="{{ trans('common.Name') }}">
                <span class="text-danger" id="name_error">{{$errors->first('name')}}</span>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="primary_input mb-15">
                <label class="primary_input_label"
                       for="">{{ __('pdf.Font File') }} ({{ trans('pdf.Normal') }}) *</label>
                <div class="primary_file_uploader">
                    <input class="primary-input imgName" type="text"
                           placeholder="{{__('common.Browse File')}}" readonly="">
                    <button class="" type="button">
                        <label class="primary-btn small fix-gr-bg">{{__('common.Browse')}}
                            <input type="file" accept=".ttf" class="d-none imgBrowse" name="font_file"></label>
                    </button>
                </div>
                <span class="text-danger" id="font_file_error">{{$errors->first('file')}}</span>
            </div>
        </div>

        <div class="col-lg-12 text-center">
            <div class="d-flex justify-content-center pt_20">
                <button type="submit" class="primary-btn fix-gr-bg"><i
                        class="ti-check"></i>
                    {{ $button_level_name }}
                </button>
            </div>
        </div>

    </div>
</form>
