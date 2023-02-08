<div class="">
    <!-- table-responsive -->
    <table class="table Crm_table_active3">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('common.Name') }}</th>
            <th scope="col">{{ trans('pdf.Font File') }} ({{ __('pdf.Normal') }})</th>
            <th scope="col">{{ __('common.Status') }}</th>
            <th scope="col">{{ __('common.Action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($fonts as $key=>$font)
            <tr>
                <th>{{ $key+1 }}</th>
                <td>{{ $font->name }}</td>
                <td>{{ $font->font_file }}</td>
                <td>
                    <label class="switch_toggle" for="active_checkbox{{ $font->id }}">
                        <input type="checkbox" class="status_change"
                               id="active_checkbox{{ $font->id }}"
                               {{ permissionCheck('pdf_fonts.update_active_status') ? '' : 'disabled' }} {{$font->is_active == 1 ? 'checked' : ''}}
                               value="{{$font->id}}">
                        <span class="slider round"></span>
                    </label>
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
                        <div class="dropdown-menu dropdown-menu-right"
                             aria-labelledby="dropdownMenu2">
                            {{--@if(permissionCheck('pdf_fonts.update'))
                                <a href="javascript:void(0)" data-item="{{ $font }}" class="dropdown-item edit_brand">{{__('common.Edit')}}</a>
                            @endif--}}
                            @if(permissionCheck('pdf_fonts.destroy'))
                                <a href="javascript:void(0)" data-item="{{ $font }}"
                                   class="dropdown-item delete_brand">{{__('common.Delete')}}</a>
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
