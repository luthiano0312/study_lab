<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ScheduleImage extends Model
{
    protected $fillable = ['user_id', 'title', 'image_path'];

    /**
     * Get the user that owns the schedule image.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retorna a URL pública da imagem armazenada no Supabase Storage.
     */
    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image_path) {
            return null;
        }

        return Storage::disk('supabase')->url($this->image_path);
    }
}
