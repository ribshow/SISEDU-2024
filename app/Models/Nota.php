<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nota_a1',
        'nota_a2',
        'nota_p1',
        'nota_p2',
        'nota_pd',
    ];

    public function aluno(): BelongsTo
    {
        return $this->BelongsTo(Aluno::class);
    }
}
