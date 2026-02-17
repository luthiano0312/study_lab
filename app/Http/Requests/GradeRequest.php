<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);
        $currentYear = (int) date('Y');

        return [
            'midterm' => [
                $isUpdate ? 'sometimes' : 'required',
                'numeric',
                'min:0',
                'max:10',
            ],
            'endterm' => [
                $isUpdate ? 'sometimes' : 'required',
                'numeric',
                'min:0',
                'max:10',
            ],
            'bimester' => [
                $isUpdate ? 'sometimes' : 'required',
                'integer',
                'min:1',
                'max:4',
            ],
            'year' => [
                $isUpdate ? 'sometimes' : 'required',
                'integer',
                'min:1900',
                'max:' . ($currentYear + 1),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'midterm.required' => 'A nota do meio do semestre é obrigatória.',
            'midterm.numeric' => 'A nota deve ser um número.',
            'midterm.min' => 'A nota não pode ser menor que 0.',
            'midterm.max' => 'A nota não pode ser maior que 10.',
            'endterm.required' => 'A nota final é obrigatória.',
            'endterm.numeric' => 'A nota deve ser um número.',
            'endterm.min' => 'A nota não pode ser menor que 0.',
            'endterm.max' => 'A nota não pode ser maior que 10.',
            'bimester.required' => 'O bimestre é obrigatório.',
            'bimester.integer' => 'O bimestre deve ser um número inteiro.',
            'bimester.min' => 'O bimestre deve ser no mínimo 1.',
            'bimester.max' => 'O bimestre não pode ser maior que 4.',
            'year.required' => 'O ano é obrigatório.',
            'year.integer' => 'O ano deve ser um número inteiro.',
            'year.min' => 'O ano não pode ser menor que 1900.',
            'year.max' => 'O ano não pode ser maior que ' . ((int) date('Y') + 1) . '.',
        ];
    }
}
