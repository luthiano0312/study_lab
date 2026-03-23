<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use App\Models\Traits\BelongsToUser;

class ScheduleImage extends Model
{
    use BelongsToUser;
    protected $fillable = ['user_id', 'title', 'image_path'];

    /**
     * Get the user that owns the schedule image.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function getImageUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->image_path);
    }
}
