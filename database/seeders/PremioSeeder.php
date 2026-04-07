<?php

namespace Database\Seeders;

use App\Models\Premio;
use Illuminate\Database\Seeder;

class PremioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $premios = [
            [
                'posicion' => 1,
                'titulo_posicion' => 'Primeros 3 lugares',
                'nombre' => "Televisor 43''",
                'descripcion' => '',
                'imagen' => '/images/premios/Premio balon mundial medpharma 2026.png',
                'pais_id' => 1,
            ],
            [
                'posicion' => 2,
                'titulo_posicion' => 'Siguientes 4 lugares',
                'nombre' => 'Tablet Samsung',
                'descripcion' => '',
                'imagen' => '/images/premios/Premio balon mundial quiniela 2026.png',
                'pais_id' => 1,
            ],
            [
                'posicion' => 3,
                'titulo_posicion' => 'Siguientes 13 lugares',
                'nombre' => 'Balón de Fútbol',
                'descripcion' => '',
                'imagen' => '/images/premios/Premio balon mundial medpharma 2026.png',
                'pais_id' => 1,
            ],

            [
                'posicion' => 1,
                'titulo_posicion' => 'Primeros 3 lugares',
                'nombre' => 'Televisor 43"',
                'descripcion' => '',
                'imagen' => '/images/premios/Premio balon mundial medpharma 2026.png',
                'pais_id' => 2,
            ],
            [
                'posicion' => 2,
                'titulo_posicion' => 'Siguientes 4 lugares',
                'nombre' => 'Tablet Samsung',
                'descripcion' => '',
                'imagen' => '/images/premios/Premio balon mundial quiniela 2026.png',
                'pais_id' => 2,
            ],
            [
                'posicion' => 3,
                'titulo_posicion' => 'Siguientes 13 lugares',
                'nombre' => 'Balón de Fútbol',
                'descripcion' => '',
                'imagen' => '/images/premios/Premio balon mundial medpharma 2026.png',
                'pais_id' => 2,
            ],
        ];

        foreach($premios as $premio) {
            Premio::create($premio);
        }
    }
}
