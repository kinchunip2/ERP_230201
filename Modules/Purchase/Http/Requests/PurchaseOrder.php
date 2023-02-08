<?php

namespace Modules\Purchase\Http\Requests;

use App\Traits\ValidationMessage;
use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrder extends FormRequest
{
    use ValidationMessage;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $setting = app('general_setting');
        $rules = [
            "supplier_id" => "required",
            "showroom" => "required",
        ];

        if ($this->getMethod() == 'POST') {
            $rules += ['product_id' => 'required'];
            $rules += ["payment_method" => "required"];
        }

        return $rules;
    }


    public function authorize()
    {
        return true;
    }
}
