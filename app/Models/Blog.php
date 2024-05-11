<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Str;


class Blog extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;
    protected $fillable = [
        'post_title',
        'post_slug',
        'content',
        'kategoris_id',
        'is_published',
        'user_id'
    ];
    public function kategoris()
    {
        return $this->belongsTo(Kategoriblog::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
