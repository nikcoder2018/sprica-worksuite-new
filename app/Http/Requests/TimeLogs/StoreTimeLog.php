<?php

namespace App\Http\Requests\TimeLogs;

use App\Http\Requests\CoreRequest;

class StoreTimeLog extends CoreRequest
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
        $rules = [
            'start_time' => 'required',
            'end_time' => 'required',
            'memo' => 'required',
            'task_id' => 'required',
            'user_id' => 'required',
            'code_id' => 'required'
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'project_id.required' => __('messages.chooseProject'),
            'task_id.required' => __('messages.fieldBlank'),
            'user_id.required' => __('messages.fieldBlank'),
            'code_id.required' => __('messages.fieldBlank')
        ];
    }

}
