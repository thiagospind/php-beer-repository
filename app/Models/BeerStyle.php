<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BeerStyle extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = ['name','description'];

    public function beers(): HasMany
    {
        return $this->hasMany(Beer::class);
    }
}
