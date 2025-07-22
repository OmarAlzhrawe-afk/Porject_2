<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class StoreStudentProfileRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'student_id' => 'required|exists:students,id|unique:student_profiles,student_id',
            'education_level_id' => 'required|exists:education_levels,id',
            'total_absences' => 'nullable|integer|min:0',
            'unexcused_absences' => 'nullable|integer|min:0',
            'score' => 'nullable|numeric|min:0|max:100',
            'behavior_notes' => 'nullable|string',
            'health_notes' => 'nullable|string',
            'interests' => 'nullable|array',
            'activities_participated' => 'nullable|array',
            'achievements' => 'nullable|array',
            'guardian_feedback' => 'nullable|string',
            'teacher_feedback' => 'nullable|string',
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
