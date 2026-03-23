<?php

namespace App\Models\Traits;

use App\Models\Scopes\UserScope;

trait BelongsToUser
{
    /**
     * Registra o Global Scope que filtra por user_id automaticamente.
     * Qualquer model que use essa trait só retornará registros do usuário autenticado.
     */
    protected static function bootBelongsToUser(): void
    {
        static::addGlobalScope(new UserScope());
    }
}
