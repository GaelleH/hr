<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'contract_start_date' => 'required|date',
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'role_id' => 'required|integer',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'contract_start_date.required' => 'De contract startdatum is verplicht!',
            'first_name.required' => 'De voornaam is verplicht!',
            'last_name.required' => 'De achternaam is verplicht!',
            'role_id.required' => 'De gebruikersrol is verplicht!',
        ];
    }
}
