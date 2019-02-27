<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAbsenceRequest extends FormRequest
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
            // 'absence_type_id' => 'required|integer',
            // 'absences_year_id' => 'required|integer',
            'user_id' => 'required|integer',
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
            // 'absence_type_id.required' => 'Het afwezigheids is verplicht!',
            // 'absences_year_id.required' => 'Het verlofjaar is verplicht!',
            'user_id.required' => 'Kies een medewerker!',
        ];
    }
}
