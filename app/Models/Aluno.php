<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aluno extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'ra',
    ];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function notas(): HasMany
    {
        return $this->HasMany(Nota::class);
    }
}
