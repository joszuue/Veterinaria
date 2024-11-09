<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Casts\MoneyCast;
class Tratamiento extends Model
{
    //
    use HasFactory;
    
    protected $casts = [
        'precio' => MoneyCast::class,
    ];

    public function paciente(): BelongsTo{
        return $this->belongsTo(Paciente::class);
    }
}
