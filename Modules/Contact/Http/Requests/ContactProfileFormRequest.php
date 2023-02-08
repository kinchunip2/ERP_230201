<?php

namespace Modules\Contact\Http\Requests;

use App\Traits\ValidationMessage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Contact\Entities\ContactModel;

class ContactProfileFormRequest extends FormRequest
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
            "name" => "required",
            "email" => "nullable",
            "tax_number" => "nullable",
            "country_id" => "sometimes|nullable|integer",
            "state_id" => "sometimes|nullable|integer",
            "city_id" => "sometimes|nullable|integer",
            "address" => "sometimes|nullable|string",
            "note" => "sometimes|nullable|string",
            "mobile" => "sometimes|nullable|string",
            'password' => 'sometimes|nullable|confirmed',
            'password_confirmation' => 'required_with:password,'
        ];



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
