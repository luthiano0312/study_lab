<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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

        return [
            'type' => [
                $isUpdate ? 'sometimes' : 'required',
                'string',
                'max:100',
            ],
            'description' => [
                $isUpdate ? 'sometimes' : 'required',
                'string',
                'max:500',
            ],
            'due_date' => [
                $isUpdate ? 'sometimes' : 'required',
                'date',
                'date_format:Y-m-d',
            ],
            'status' => [
                $isUpdate ? 'sometimes' : 'required',
                'string',
                'in:pending,in_progress,completed',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'O tipo de prova é obrigatório.',
            'type.string' => 'O tipo de prova deve ser um texto.',
            'type.max' => 'O tipo não pode ter mais de 100 caracteres.',
            'description.required' => 'A descrição é obrigatória.',
            'description.string' => 'A descrição deve ser um texto.',
            'description.max' => 'A descrição não pode ter mais de 500 caracteres.',
            'due_date.required' => 'A data de realização é obrigatória.',
            'due_date.date' => 'A data deve ser válida.',
            'due_date.date_format' => 'A data deve estar no formato YYYY-MM-DD.',
            'status.required' => 'O status é obrigatório.',
            'status.string' => 'O status deve ser um texto.',
            'status.in' => 'O status deve ser: pending, in_progress ou completed.',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Normalizar dados de entrada
        if ($this->has('status')) {
            $this->merge([
                'status' => strtolower(trim($this->status)),
            ]);
        }

        if ($this->has('type')) {
            $this->merge([
                'type' => trim($this->type),
            ]);
        }

        if ($this->has('description')) {
            $this->merge([
                'description' => trim($this->description),
            ]);
        }
    }
}
