<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
            'xsbh'      =>  'required|numeric|exists:table_xsxx,xsbh',
            'phone'     =>  'required|digits:11|exists:table_xsxx,sjhm',
        ];
    }
}
