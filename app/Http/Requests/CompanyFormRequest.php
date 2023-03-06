<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyFormRequest extends FormRequest
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
            'moneies_id' => [
                'required',
                'integer'
            ],
            'num_asset' => [
                'required',
                'string',
                'max:255'
            ],
            'date_into' => [
                'required',
                'date'
            ],
            'name_asset' => [
                'required',
                'string',
                'max:255'

            ],
            'detail' => [
                'required',
                'longText'
            ],
            'unit' => [
                'required',
                'string',
                'max:255'
            ],
            'place' => [
                'required',
                'string',
                'max:255'
            ],
            'per_price' => [
                'required',
                'double',
                '10,2'
            ],
            'status_buy' => [
                'required',
                'string',
                'max:255'
            ],
            'num_old_asset' => [
                'required',
                'string',
                'max:255'
            ],
            'pic' => [
                'nullable',
                'mimes:jpg,jpeg,png'
            ],
            'fullname' => [
                'required',
                'string',
                'max:255'
            ],
            'department' => [
                'required',
                'string',
                'max:255'
            ],
            'name_info' => [
                'required',
                'string',
                'max:255'
            ],
            'num_department' => [
                'required',
                'string',
                'max:255'
            ]

        ];
    }
}