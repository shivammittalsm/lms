<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'email:rfc,dns',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'courseId' => 'required',
        ];
    }
}
