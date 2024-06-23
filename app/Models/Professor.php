<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Professor extends Model
{
    use HasFactory;

    protected $table = 'professores';

    protected $fillable = [
        'rm',
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
