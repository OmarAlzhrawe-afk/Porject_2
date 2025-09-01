<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreStudentProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'student_id' => 'required|exists:students,id|exists:student_profiles,student_id',
            'behavior_notes' => 'nullable|string',
            'health_notes' => 'nullable|string',
            'interests' => 'nullable|array',
            'activities_participated' => 'nullable|array',
            'achievements' => 'nullable|array',
            'skills' => 'nullable|array',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'Validation error Bad Request',
            'errors' => $validator->errors()
        ], 422));
    }
}
