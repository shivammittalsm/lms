<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'options' => 'required',
            'correctOptions' => 'required',
            'question_title' => 'required',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator){
            if(!empty($this->options)) {
                $count = 0;
                foreach($this->options as $o) {
                    if($o != null){
                        $count ++;
                    }
                }
                
                if( $count < 2 ){
                    $validator->errors()->add('options', 'Please add at least two options to continue.');
                }
            }
        });
    }
}
