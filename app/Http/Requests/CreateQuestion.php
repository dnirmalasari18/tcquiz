<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateQuestion extends FormRequest
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
            'question_description' => 'required',
            'option_1' => 'required',
            'option_2' => 'required',
            'correct_answer' => 'required',
            'question_score' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'question_description.required' => 'Question description cannot be empty',
            'option_1.required' => 'Pilihan A tidak boleh kosong',
            'option_2.required' => 'Pilihan B tidak boleh kosong',
            'correct_answer.required' => 'Choose one correct answer',
            'question_score.required' => 'Question score cannot be empty',
        ];
    }
}
