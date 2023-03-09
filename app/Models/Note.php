<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Note extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    protected $appends = ['image_url'];

    public function getImageUrlAttribute() {
        return url(config('custom.PATH').$this->attributes['image']);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
