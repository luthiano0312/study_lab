<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Traits\BelongsToUser;

class ScheduleImage extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'image_path',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getImageUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->image_path);
    }
}
