<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationPostRequest extends FormRequest
{
     /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:140',
            'province_id' => 'required|digits_between:1,52',
            'type_id' => 'exists:organization_types,id',
            'address' => 'required|max:200',
            'address_2' => 'nullable|max:200',
            'city' => 'required|max:90',
            'postal_code' => 'required|max:5',
            'phone' => 'nullable|max:10',
            'website' => 'nullable|url|max:155',
            'email' => 'nullable|email|max:45',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:1024'
        ];
    }
}
