<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrganizationType extends Model
{
    public $timestamps = false;

    protected $fillable = ['name', 'name_plural', 'slug_plural'];

    public function organization(): HasMany
    {
        return $this->hasMany(Organization::class, 'type_id', 'id');
    }

    public function setNameAttribute(string $name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = \Str::slug($name);
    }
}
