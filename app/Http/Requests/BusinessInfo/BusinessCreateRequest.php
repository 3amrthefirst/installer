<?php

namespace App\Http\Requests\BusinessInfo;

use Illuminate\Foundation\Http\FormRequest;

class BusinessCreateRequest extends FormRequest
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
            'company_name'        => 'required|string',
            'phone'               => 'required|numeric|min:10',
            'business_fax'        => 'required',
            'logo_url'            => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4000',
            'address'             => 'required|string',
            'date_of_origination' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'user_id.required'                => 'you must be authenticated',
            'company_name.required'           => 'you must put your company name',
            'company_name.string'             => 'your company name must be string',
            'phone.required'                  => 'you must put your phone number',
            'phone.numeric'                   => 'your phone must be numeric',
            'phone.min'                       => 'your phone must be min 10 numbers',
            'business_fax.required'           => 'you must put your business_fax',
            'logo_url.required'               => 'you must put your company logo',
            'logo_url.image'                  => 'your logo must be image',
            'logo_url.mimes'                  => 'your logo must be  jpeg or png or jpg or gif or svg',
            'address.required'                => 'you must put your address',
            'address.string'                  => 'your address must be string',
            'date_of_origination.required'    => 'you must put your date_of_origination',
        ];
    }
}
