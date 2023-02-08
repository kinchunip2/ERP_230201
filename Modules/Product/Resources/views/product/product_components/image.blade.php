@if (@$productSkus->product->product_type == "Single" && @$productSkus->product->image_source != null)
    <img style="height: 36px;"
         src="{{asset(@$productSkus->product->image_source ?? 'public/backEnd/img/no_image.png')}}"
         alt="{{@$productSkus->product->product_name}}">
@elseif(@$productSkus->product->product_type == "Variable" && @$productSkus->product->image_source != null)
    <img style="height: 36px;"
         src="{{asset(@$productSkus->product_variation->image_source ?? 'public/backEnd/img/no_image.png')}}"
         alt="{{@$productSkus->product->product_name}}">
@else
    <img style="height: 36px;"
         src="{{asset('public/backEnd/img/no_image.png')}}"
         alt="{{@$productSkus->product->product_name}}">
@endif
