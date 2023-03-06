<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            /*
            'code_money' => 'required|numeric',
            'name_money' => 'required|string|max:255',
            'budget' => 'required|numeric',

            'num_asset' => 'required|string|max:255',
            'date_into' =>   'required|date',
            'name_asset' => 'required|string|max:255',
            'detail' => 'required|longText',
            'unit' =>   'required|string|max:255',
            'place' => 'required|string|max:255',
            'per_price' =>  'required|double|10,2',
            'status_buy' => 'required|string|max:255',
            'num_old_asset' => 'required|string|max:255',
            'cover' =>    'nullable|mimes:jpg,jpeg,png',
            'fullname' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'name_info' => 'required|string|max:255',
            'num_department' => 'required|string|max:255',
            */


            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'num_position' => ['required', 'numeric', 'max:10'],
            'position' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'task' => ['required', 'string', 'max:255'],
            'is_admin' => ['required', 'numeric', 'regex:/^[0-1]{1}$/'],

        ];
    }
    public function message()
    {
        return [
            'is_admin.regex' => ':attribute only accepts 0 or 1.',
            'num_position.regex' => ':attribute only accepts 0 or 1.',
        ];
    }
}