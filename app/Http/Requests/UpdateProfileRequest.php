<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        $userId = $this->user()->id;

        return [
        'name'             => 'sometimes|string|max:255',
        'email'            => 'sometimes|email|unique:users,email,' . $this->user()->id,
        'password'         => 'sometimes|min:8|confirmed',
        'current_password' => 'required_with:password',
        'card_color'       => 'sometimes|string|in:rosa,roxo,azul,verde,laranja,preto,vermelho,branco,ciano,amarelo,indigo,rosegold',
        'preset_avatar'    => 'sometimes|integer|min:0|max:20',
        'avatar_url'       => 'sometimes|string',
        'onboarding_done'  => 'sometimes|boolean',
        'avatar'           => 'sometimes|image|max:2097152',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string'    => 'O nome deve ser um texto.',
            'name.max'       => 'O nome não pode ter mais de 255 caracteres.',
            'email.email'    => 'Informe um e-mail válido.',
            'email.unique'   => 'Este e-mail já está em uso.',
            'avatar.image'   => 'O arquivo do avatar deve ser uma imagem.',
            'avatar.max'     => 'A imagem do avatar não pode exceder 2MB.',
        ];
    }
}
