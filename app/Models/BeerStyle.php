<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class BeerStyle extends Model
{
    use HasApiTokens, HasFactory, softDeletes;

    protected $fillable = ['name','description'];

    public function beers(): HasMany
    {
        return $this->hasMany(Beer::class);
    }
}
