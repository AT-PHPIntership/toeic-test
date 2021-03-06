<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class PostPart4AndPart5Request extends FormRequest
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
            'question.*.content'=>'required',
            'question.*.answer.*'=>'required',
            'question.*.correct'=>'required',
        ];
    }

    /**
     * Messages errors part 4 and part 5
     *
     * @return string for requestion
     */
    public function messages()
    {
        $messages = [
            'question.*.content.required'=>'Please, enter content for question',
            'question.*.answer.*.required'=>'Please, enter answer for question',
            'question.*.correct.required'=>'Please, enter correct for question',
        ];
        return $messages;
    }
}
