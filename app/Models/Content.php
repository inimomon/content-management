<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    protected $table = 'content';
    protected $primaryKey = 'id_content';

    protected $fillable = [
        'judul',
        'tenggat',
        'status',
        'creator',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator', 'id');
    }
}