<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Province extends Model
{
    use HasFactory;

    public $incrementing = false;

    public $timestamps = false;

    protected $with = [
        'state:id,name',
    ];

    public function state(): HasOne
    {
        return $this->hasOne(State::class, 'id', 'id_state');
    }
}
