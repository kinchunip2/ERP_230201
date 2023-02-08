<?php

namespace Modules\Account\Http\Requests;

use App\Traits\ValidationMessage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChartAccountFormRequest extends FormRequest
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
            "name" => [
                'required'
            ],
            "status" => "required",
            'description' => 'nullable',
            'as_sub_category' => 'nullable'
        ];

        if (!$this->id){
            $rules['type'] = ['required'];
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
