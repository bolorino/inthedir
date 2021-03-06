<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'province_id',
        'type_id',
        'slug',
        'address',
        'address_2',
        'city',
        'postal_code',
        'phone',
        'website',
        'email',
        'image',
        'logo'
    ];

    // protected $with = 'province:id, name';

    public function province(): HasOne
    {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function provinceAndState(): Builder
    {
        return $this->whereHasMorph('organizations', [Province::class, State::class]);
    }

    public function type(): HasOne
    {
        return $this->hasOne(OrganizationType::class, 'id', 'type_id');
    }

    public function setNameAttribute(string $name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = \Str::slug($name);
    }
}
