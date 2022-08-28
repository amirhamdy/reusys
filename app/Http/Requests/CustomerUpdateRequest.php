<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'phone' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
            'fax' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'billing_address' => ['required', 'max:255', 'string'],
            'postal_code' => ['required', 'max:255', 'string'],
            'website' => ['required', 'max:255', 'string'],
            'city' => ['required', 'max:255', 'string'],
            'customer_status_id' => ['required', 'exists:customer_statuses,id'],
            'country_id' => ['required', 'exists:countries,id'],
            'region_id' => ['required', 'exists:regions,id'],
            'customer_rating_id' => ['required', 'exists:customer_ratings,id'],
            'industry_id' => ['required', 'exists:industries,id'],
        ];
    }
}
