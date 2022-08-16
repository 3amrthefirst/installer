<?php

namespace App\Http\Requests\BusinessLicense;

use Illuminate\Foundation\Http\FormRequest;

class licenseCreateRequest extends FormRequest
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
            'license_number'          => 'required|numeric',
            'license_img'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4000',
            'license_type'            => 'required|in:1,2,3,4,5',
            'state'                   => 'required|string' ,
            'license_expiration_date' => 'required|date',
        ];
    }


    public function messages()
    {
        return [
            'user_id.required'                 => 'you must be authenticated',
            'license_number.required'          => 'you must put your license_number',
            'license_number.numeric'           => 'your license_number must be string',
            'license_img.required'             => 'you must put your license_img',
            'license_img.image'                => 'your license_img must be image',
            'license_img.mimes'                => 'your license_img must be  jpeg or png or jpg or gif or svg',
            'license_type.required'            => 'you must put your license_type',
            'state.required'                   => 'you must put your state',
            'state.string'                     => 'your state must be string',
            'license_expiration_date.required' => 'you must put your license_expiration_date',
            'license_expiration_date.date'     => 'your license_expiration_date must be a date',
        ];
    }
}
