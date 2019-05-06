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
            'option_a' => 'required',
            'option_b' => 'required',
            'correct_answer' => 'required',
            'question_score' => 'required',
        ];
    }

    public function messages()
    {
        return [
          'question_description.required' => 'Question tidak boleh kosong',
            'option_a.required' => 'Pilihan A tidak boleh kosong',
            'option_b.required' => 'Pilihan B tidak boleh kosong',
            'correct_answer.required' => 'Jawaban tidak boleh kosong',
            'question_score.required' => 'Bobot tidak boleh kosong',
        ];
    }
}
