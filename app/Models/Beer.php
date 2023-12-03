<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use test\Mockery\ReturnTypeUnionTypeHint;

class Beer extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name',
        'abv',
        'color',
        'brewery',
        'beer_styles_id'
    ];

    public function style(): BelongsTo
    {
        return $this->belongsTo(BeerStyle::class);
    }
}
