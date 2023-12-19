<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Beer extends Model
{
    use HasApiTokens, HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'abv',
        'color',
        'brewery',
        'beer_style_id'
    ];

    public function style(): BelongsTo
    {
        return $this->belongsTo(BeerStyle::class, 'beer_style_id');
    }
}
