<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'title' => ['nullable', 'string', 'max:255'],
        ];
        // dd($rules['image']);
        if ($this->isMethod('POST')) {
            $rules['image'] = ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'];
        } else {
            $rules['image'] = ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'image.required' => 'A imagem do horário é obrigatória.',
            'image.image'    => 'O arquivo deve ser uma imagem.',
            'image.mimes'    => 'A imagem deve ser do tipo: jpg, jpeg, png ou webp.',
            'image.max'      => 'A imagem não pode ter mais que 5MB.',
            'title.max'      => 'O título não pode ter mais que 255 caracteres.',
        ];
    }
}
