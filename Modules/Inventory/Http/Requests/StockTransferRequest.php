<?php

namespace Modules\Inventory\Http\Requests;

use App\Traits\ValidationMessage;
use Illuminate\Foundation\Http\FormRequest;

class StockTransferRequest extends FormRequest
{
    use ValidationMessage;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'date' => 'required',
            'from' => 'required',
            'to' => 'required',
        ];

        if ($this->getMethod() == 'POST') {
            $rules += ['product_id' => 'required'];
        }
        return $rules;
    }

    public function authorize()
    {
        return true;
    }
}
