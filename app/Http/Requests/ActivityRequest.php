<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ActivityRequest extends FormRequest
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
                'errors' => $validator->errors()
            ], 422)
        );
    }

    protected function prepareForValidation(): void
    {
        // Converter data de d-m-Y para Y-m-d ANTES da validação
        if ($this->has('due_date') && $this->due_date) {
            $parts = explode('-', $this->due_date);
            if (count($parts) === 3) {
                $this->merge([
                    'due_date' => "{$parts[2]}-{$parts[1]}-{$parts[0]}",
                ]);
            }
        }

        // Normalizar status
        if ($this->has('status')) {
            $this->merge([
                'status' => strtolower(trim($this->status)),
            ]);
        }

        // Normalizar description
        if ($this->has('description')) {
            $this->merge([
                'description' => trim($this->description),
            ]);
        }
    }

    public function rules(): array
    {
        $isUpdate = in_array($this->method(), ['PUT', 'PATCH']);

        return [
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
            'description.required' => 'A descrição é obrigatória.',
            'description.string' => 'A descrição deve ser um texto.',
            'description.max' => 'A descrição não pode ter mais de 500 caracteres.',
            'due_date.required' => 'A data de vencimento é obrigatória.',
            'due_date.date' => 'A data de vencimento deve ser uma data válida.',
            'due_date.date_format' => 'A data de vencimento deve estar no formato DD-MM-YYYY.',
            'status.required' => 'O status é obrigatório.',
            'status.string' => 'O status deve ser um texto.',
            'status.in' => 'O status deve ser: pending, in_progress ou completed.',
        ];
    }
}
