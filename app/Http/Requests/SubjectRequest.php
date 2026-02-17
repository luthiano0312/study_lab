<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
        $subjectId = $isUpdate ? $this->route('subject')->id : null;

        return [
            'name' => [
                $isUpdate ? 'sometimes' : 'required',
                'string',
                'max:255',
                'unique:subjects,name' . ($subjectId ? ',' . $subjectId : ''),
            ],
            'abbreviation' => [
                $isUpdate ? 'sometimes' : 'required',
                'string',
                'max:10',
                'unique:subjects,abbreviation' . ($subjectId ? ',' . $subjectId : ''),
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
            'name.required' => 'O nome da matéria é obrigatório.',
            'name.string' => 'O nome da matéria deve ser um texto.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'name.unique' => 'Esta matéria já está registrada.',
            'abbreviation.required' => 'A abreviação é obrigatória.',
            'abbreviation.string' => 'A abreviação deve ser um texto.',
            'abbreviation.max' => 'A abreviação não pode ter mais de 10 caracteres.',
            'abbreviation.unique' => 'Esta abreviação já está em uso.',
            'teacher.required' => 'O nome do professor é obrigatório.',
            'teacher.string' => 'O nome do professor deve ser um texto.',
            'teacher.max' => 'O nome não pode ter mais de 255 caracteres.',
            'semester.required' => 'O semestre é obrigatório.',
            'semester.integer' => 'O semestre deve ser um número inteiro.',
            'semester.min' => 'O semestre deve ser no mínimo 1.',
            'semester.max' => 'O semestre não pode ser maior que 8.',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Normalizar dados de entrada
        if ($this->has('name')) {
            $this->merge([
                'name' => trim($this->name),
            ]);
        }

        if ($this->has('abbreviation')) {
            $this->merge([
                'abbreviation' => strtoupper(trim($this->abbreviation)),
            ]);
        }

        if ($this->has('teacher')) {
            $this->merge([
                'teacher' => trim($this->teacher),
            ]);
        }
    }
}
