<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class StoreActivityRequest extends FormRequest
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
            'Title' => 'required|string|max:255',
            'class_room_id' => 'nullable|exists:class_rooms,id',
            'education_level_id' => 'nullable|exists:education_levels,id',
            'Description' => 'required|string',
            'activity_type' => 'required|in:trip,sports,art,competition,course,other',
            'date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'target_group' => 'required|in:all,class,stage,specific',
            'is_paid' => 'required|boolean',
            'cost' => 'nullable|integer',
            'seats_limit' => 'nullable|integer',
            'registration_deadline' => 'required|date',
            'is_open' => 'boolean',
            'auto_filter_participants' => 'required|boolean',
            'required_skills' => 'nullable|array',
            'required_skills.*' => 'string',
            'gallery' => 'nullable|array',
            'gallery.*' => 'file|mimes:mp4,jpeg,jpg,png|max:20480|max:20480',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ], 422));
    }
}
