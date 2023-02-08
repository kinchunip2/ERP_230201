<?php

namespace Modules\Sale\Http\Requests;

use App\Traits\ValidationMessage;
use Illuminate\Foundation\Http\FormRequest;

class SaleQuotationRequest extends FormRequest
{
    use ValidationMessage;

    public function rules()
    {
        $rules = [
            "customer_id" => "required",
            "date" => "required",
            "warehouse_id" => "required",
        ];

        if ($this->getMethod() == 'POST') {
            $rules += ['product_id' => 'required_without_all:items,combo_items,product'];
            $rules += ["payment_method" => "required"];
        }
        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
