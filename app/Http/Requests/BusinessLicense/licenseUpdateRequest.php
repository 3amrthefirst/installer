<?php

namespace App\Http\Requests\BusinessLicense;

use Illuminate\Foundation\Http\FormRequest;

class licenseUpdateRequest extends FormRequest
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
            'license_number'          => 'numeric',
            'license_img'             => 'image|mimes:jpeg,png,jpg,gif,svg|max:4000',
            'license_type'            => 'in:1,2,3,4,5',
            'state'                   => 'string' ,
            'license_expiration_date' => 'date',
        ];
    }
    public function messages()
    {
        return [
            'license_number.numeric'           => 'your license_number must be string',
            'license_img.image'                => 'your license_img must be image',
            'license_img.mimes'                => 'your license_img must be  jpeg or png or jpg or gif or svg',
            'state.string'                     => 'your state must be string',
            'license_expiration_date.date'     => 'your license_expiration_date must be a date',
        ];
    }
}
