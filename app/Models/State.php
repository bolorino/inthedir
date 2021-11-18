<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class State extends Model
{
    use HasFactory;

    public $incrementing = false;

    public $timestamps = false;

    public function province(): HasMany
    {
        return $this->hasMany(Province::class, 'id_state', 'id');
    }

    public function getBySlug(string $slug)
    {
        return $this->firstWhere('slug', $slug);
    }
}
