<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AbsenceYearStoreRequest extends FormRequest
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
            'official_leave_hours' => 'required|integer',
            'user_id' => 'required|integer',
            'year' => 'required|integer',
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
            'official_leave_hours.required' => 'Het aantal officiële verlofuren is verplicht!',
            'user_id.required' => 'Een gebruiker is verplicht!',
            'year.required' => 'Het verlofjaar is verplicht!',
        ];
    }
}
