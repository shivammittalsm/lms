<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'course_title' => 'required',
            'question_ids' => 'required|exists:questions,id',
        ];
    }

    public function messages()
    {
        return[
            'course_title.required' => 'The course title field is required.',
            'question_ids.required' => 'Please add at least one question to continue',
        ];
    }
}
