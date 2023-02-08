<table class="table Crm_table_active3">
    <thead>
    <tr>

        <th scope="col">{{ __('common.Sl') }}</th>
        <th scope="col">{{ __('product.Variant Name') }}</th>
        <th scope="col">{{ __('product.Description') }}</th>
        <th scope="col">{{ __('common.Status') }}</th>
        <th scope="col">{{ __('common.Action') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($variants as $key=>$variant_value)
        <tr>

            <th>{{ $key+1 }}</th>
            <td>{{ $variant_value->name }}</td>
            <td>{{ $variant_value->description }}</td>
            <td>
                @if($variant_value->status == 1)
                    <span class="badge_1">{{ __('common.Active') }}</span>
                @else
                    <span class="badge_4">{{ __('common.Deactive') }}</span>
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
                    <div class="dropdown-menu dropdown-menu-right"
                         aria-labelledby="dropdownMenu2">
                        @if(permissionCheck('variant.edit'))
                            <a href="#" data-toggle="modal" data-target="#Item_Edit"
                               class="dropdown-item edit_variant"
                               data-value="{{$variant_value->id}}" type="button">{{ __('common.Edit') }}</a>
                        @endif

                        @if(permissionCheck('variant.show'))

                            <a href="{{ route('variant.show', $variant_value->id) }}" class="dropdown-item">{{ __('common.View') }}</a>

                        @endif

                        @if(permissionCheck('variant.destroy'))

                            <a onclick="confirm_modal('{{route('variant.delete',$variant_value->id)}}');"
                               class="dropdown-item ">{{__('common.Delete')}}</a>
                        @endif

                    </div>
                </div>
                <!-- shortby  -->
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
