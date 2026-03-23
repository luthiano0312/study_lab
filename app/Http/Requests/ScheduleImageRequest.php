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
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH')
            || $this->input('_method') === 'PUT';

        return [
            'title' => ['required', 'string', 'max:255'],
            'image' => [
                $isUpdate ? 'nullable' : 'required',
                'file',
                'image',
                'mimes:jpeg,jpg,png,webp,gif',
                'max:10240', // 10MB
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'  => 'Informe um título para o horário.',
            'title.max'       => 'O título pode ter no máximo 255 caracteres.',
            'image.required'  => 'Selecione uma imagem.',
            'image.file'      => 'O arquivo enviado é inválido.',
            'image.image'     => 'O arquivo precisa ser uma imagem.',
            'image.mimes'     => 'Formatos aceitos: JPEG, JPG, PNG, WEBP, GIF.',
            'image.max'       => 'A imagem não pode ultrapassar 10MB.',
        ];
    }
}
