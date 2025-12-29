<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminResponseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'respondable_type' => 'required|in:facility_report,aspiration',
            'respondable_id' => 'required',
            'message' => 'required|min:5',
            'action_status' => 'nullable|in:submitted,in_progress,resolved,rejected,reviewed,accepted',
        ];
    }
    public function withValidator($validator){
        $validator->after(function($validator){
            if ($this->respondable_type === 'facility_report' && !FacilityReport::find($this->respondable_id)){
                $validator->errors()->add('respondable_id', 'Facility report tidak ditemukan');
            }

            if ($this->respondable_type === 'aspiration' && !Aspiration::find($this->respondable_id)){
                $validator->errors()->add('respondable_id', 'Aspiration tidak ditemukan');
            }
        });
    }
}
