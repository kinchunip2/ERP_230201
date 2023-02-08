<div class="dropdown CRM_dropdown">
    <button class="btn btn-secondary dropdown-toggle"
            type="button" id="dropdownMenu2"
            data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false"> {{__('common.select')}}
    </button>
    <div class="dropdown-menu dropdown-menu-right"
         aria-labelledby="dropdownMenu2">
        @if(permissionCheck('add_product.edit'))
            <a href="{{route('add_product.edit',$productSkus->product_id)}}"
               class="dropdown-item"
               type="button">{{__('common.Edit')}}</a>

            @if ($productSkus->suggested()->exists())
                <a href="javascript:void(0)"
                   class="dropdown-item"
                   type="button">{{__('purchase.Added To Suggested')}}</a>
            @endif

        @endif
        @php
            $image = $productSkus->product->product_type == 'Variable' ? asset($productSkus->product_variation->image_source) : asset($productSkus->product->image_source);
        @endphp
        @if ($productSkus->barcode_type)
            <a href="#" data-id="{{$productSkus->id}}"
               data-toggle="modal"
               onclick="barcodeGenerator('{{$image}}','{{$productSkus->product->product_name}}','{{$productSkus->sku}}','{{$productSkus->id}}','{{@$productSkus->stock->stock}}')"
               class="dropdown-item generate_barcode"
               data-target="#generate_barcode">{{__('product.Generate Barcode')}}</a>
        @endif
        @if(permissionCheck('add_product.index'))
            <a href="#" data-toggle="modal"
               class="dropdown-item"
               onclick="product_detail({{ $productSkus->product_id }} , 'null')">{{__('common.View')}}</a>
        @endif
        @if(permissionCheck('add_product.destroy') && $productSkus->sku_products->count() == 0)
            <a onclick="confirm_modal('{{route('add_product.destroy',$productSkus->product_id)}}');"
               class="dropdown-item edit_brand">{{__('common.Delete')}}</a>
        @endif
        <a href="{{route('add_product.selling_price_history',$productSkus->id)}}" class="dropdown-item" type="button">{{__('product.Selling Price History')}}</a>
    </div>
</div>
