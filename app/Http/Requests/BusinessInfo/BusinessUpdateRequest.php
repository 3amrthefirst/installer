<?php

namespace App\Http\Requests\BusinessInfo;

use Illuminate\Foundation\Http\FormRequest;

class BusinessUpdateRequest extends FormRequest
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
            'company_name'        => 'string',
            'phone'               => 'numeric|min:10',
            //'business_fax'        => '',
            'logo_url'            => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address'             => 'string',
        ];
    }

    public function messages()
    {
        return [
            'company_name.string'             => 'your company name must be string',
            'phone.numeric'                   => 'your phone must be numeric',
            'phone.min'                       => 'your phone must be min 10 numbers',
            'logo_url.image'                  => 'your logo must be image',
            'logo_url.mimes'                  => 'your logo must be  jpeg or png or jpg or gif or svg',
            'address.string'                  => 'your address must be string',
        ];
    }
}
