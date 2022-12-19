<?php

namespace Modules\Company\Http\Requests;

use App\Http\Requests\XRequest;

// use Illuminate\Foundation\Http\FormRequest;


class CompanyRequest extends XRequest
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
            'name' => 'required',
            'foundation' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'whatsapp_1' => 'required',
            'whatsapp_2' => 'nullable',
            'twitter' => 'nullable',
            'youtube' => 'nullable',
            'linkedin' => 'nullable',
            'address_street' => 'required',
            'address_number' => 'nullable',
            'address_neighborhood' => 'required',
            'address_city' => 'required',
            'address_state' => 'required',
            'address_zipcod' => 'nullable',
            'opening_hours' => 'nullable',
            'map' => 'nullable',
        ];
    }
}