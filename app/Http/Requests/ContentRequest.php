<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ContentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Validação falhou',
                'errors' => $validator->errors(),
            ], 422)
        );
    }

    public function rules(): array
    {
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);
        $contentId = $isUpdate && $this->route('content')
            ? $this->route('content')->id
            : null;

        return [
            'name' => [
                $isUpdate ? 'sometimes' : 'required',
                'string',
                'max:255',
                'unique:contents,name' . ($contentId ? ',' . $contentId : ''),
            ],
            'teacher' => [
                $isUpdate ? 'sometimes' : 'required',
                'string',
                'max:255',
            ],
            'semester' => [
                $isUpdate ? 'sometimes' : 'required',
                'integer',
                'min:1',
                'max:8',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'O nome do conteúdo é obrigatório.',
            'name.string'       => 'O nome do conteúdo deve ser um texto.',
            'name.max'          => 'O nome não pode ter mais de 255 caracteres.',
            'name.unique'       => 'Este conteúdo já está registrado.',
            'teacher.required'  => 'O nome do professor é obrigatório.',
            'teacher.string'    => 'O nome do professor deve ser um texto.',
            'teacher.max'       => 'O nome não pode ter mais de 255 caracteres.',
            'semester.required' => 'O semestre é obrigatório.',
            'semester.integer'  => 'O semestre deve ser um número inteiro.',
            'semester.min'      => 'O semestre deve ser no mínimo 1.',
            'semester.max'      => 'O semestre não pode ser maior que 8.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('name')) {
            $this->merge(['name' => trim($this->name)]);
        }
        if ($this->has('teacher')) {
            $this->merge(['teacher' => trim($this->teacher)]);
        }
    }
}
