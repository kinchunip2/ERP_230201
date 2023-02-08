<?php

namespace Modules\Account\Http\Requests;

use App\Traits\ValidationMessage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JournalFormRequest extends FormRequest
{
    use ValidationMessage;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
              "date" => "required",
              "account_type" => "required",
              "account_id" => "required",
              "narration" => "nullable",
              "main_amount" =>'required|same:sub_amounts',
              "sub_account_id" => "required",
              "sub_amount" => "required",
              "sub_narration" => "required",
              "sub_amounts" => "required"

        ];
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
