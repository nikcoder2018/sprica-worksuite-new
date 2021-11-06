<?php

namespace App\Http\Requests\CodeSetting;

use Illuminate\Foundation\Http\FormRequest;

class StoreCode extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'code_number' => 'required',
            'code_title' => 'required|string',
            'code_money_1' => 'required',
            'code_money_2' => 'required'
        ];
    }
}
