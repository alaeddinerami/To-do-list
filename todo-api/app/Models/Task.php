<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable =[
        'title',
        'description',
        'completed',
        'user_id',
    ];
       public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
