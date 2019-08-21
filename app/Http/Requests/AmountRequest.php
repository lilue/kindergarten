<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AmountRequest extends FormRequest
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
            'id'        =>  'required|numeric|exists:table_sfdmx,xsbh',
            'dh'        =>  'required|exists:table_sfdmx,sfdh',
            'djje'      =>  'required',
            'amount'    =>  'required|integer|lte:djje',
        ];
    }
}
