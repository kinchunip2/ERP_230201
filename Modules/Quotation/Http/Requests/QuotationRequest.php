<?php

namespace Modules\Quotation\Http\Requests;

use App\Traits\ValidationMessage;
use Illuminate\Foundation\Http\FormRequest;

class QuotationRequest extends FormRequest
{
    use ValidationMessage;

    public function rules()
    {
        return [
            'customer_id' => 'required',
            'date' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
