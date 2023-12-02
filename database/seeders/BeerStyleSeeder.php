<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BeerStyle;

class BeerStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BeerStyle::create([
            'name' => 'Pilsen',
            'description' => 'Cerveja leve, com baixo teor alcoólico,
                              pode ser puro malte ou usar adjuntos, de cor amarelo claro.'
        ]);
        BeerStyle::create([
            'name' => 'Sour',
            'description' => 'Cerveja leve, com baixo teor alcoólico,
                              tem como característica a acidez. Pode levar frutas tropicais na composição.'
        ]);
        BeerStyle::create([
            'name' => 'RIS',
            'description' => 'Cerveja escura, de corpo alto, teor alcoólico alto,
                              apresenta notas acentuadas de café, torra, pode ter madeira
                              ou outros adjuntos.'
        ]);
        BeerStyle::create([
            'name' => 'IPA',
            'description' => 'Cerveja de corpo baixo a médio, teor alcoólico de moderado a alto
                              geralmente apresenta características marcantes de lúpulo
                              no sabor e aroma. Apresenta cor amalero médio.'
        ]);
        BeerStyle::create([
            'name' => 'Session IPA',
            'description' => 'Cerveja de corpo baixo, teor alcoólico baixo,
                              geralmente apresenta características marcantes de lúpulo
                              no sabor e aroma. Apresenta cor amalero claro.'
        ]);

    }
}
