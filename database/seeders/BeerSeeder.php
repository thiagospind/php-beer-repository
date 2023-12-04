<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Beer;
use App\Models\BeerStyle;

class BeerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Beer::create([
            'name' => 'Pilsner Urquell',
            'abv' => '4.4',
            'color' => 'Dourado claro a âmbar',
            'brewery' => 'Pilsner Urquell',
            'beer_style_id' => 1
        ]);
        Beer::create([
            'name' => 'Maracujá Frescor Azedo',
            'abv' => '6.2',
            'color' => 'Amarelo intenso',
            'brewery' => 'Cervejaria Coza Linda',
            'beer_style_id' => 2
        ]);
        Beer::create([
            'name' => 'Wäls Petroleum',
            'abv' => '12',
            'color' => 'Preta opaca',
            'brewery' => 'Cervejaria Wäls',
            'beer_style_id' => 3
        ]);
        Beer::create([
            'name' => 'Interstellar ',
            'abv' => '7',
            'color' => 'Amarelo intenso',
            'brewery' => 'Cervejaria Hocus Pocus',
            'beer_style_id' => 4
        ]);
        Beer::create([
            'name' => 'Session Citra',
            'abv' => '4.4',
            'color' => 'Amarelo claro',
            'brewery' => 'Cervejaria Tupiniquim',
            'beer_style_id' => 5
        ]);

    }
}
