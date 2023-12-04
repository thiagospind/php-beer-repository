<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('beers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->float('abv');
            $table->string('color');
            $table->string('brewery');
            $table->unsignedInteger('beer_style_id');
            $table->foreign('beer_style_id')->references('id')->on('beer_styles');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beers');
    }
};
