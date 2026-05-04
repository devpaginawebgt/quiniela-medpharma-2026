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
                'titulo_posicion' => 'Primero al quinto lugar',
                'nombre' => "Televisor 55''",
                'imagen' => '/images/premios/gt/Premio TV quiniela 2026.png',
                'pais_id' => 1,
            ],
            [
                'posicion' => 2,
                'titulo_posicion' => 'Sexto al décimo lugar',
                'nombre' => 'Bocina Bluetooth',
                'imagen' => '/images/premios/gt/Premio parlante quiniela 2026.png',
                'pais_id' => 1,
            ],
            [
                'posicion' => 3,
                'titulo_posicion' => 'Decimoprimero al decimoquinto lugar',
                'nombre' => 'Giftcard de Q500.00',
                'imagen' => '/images/premios/gt/Premio giftcard quiniela 2026.png',
                'pais_id' => 1,
            ],

            // El Salvador (SV)
            [
                'posicion' => 1,
                'titulo_posicion' => 'Primer y segundo lugar',
                'nombre' => "Televisor 55''",
                'imagen' => '/images/premios/es/Premio TV quiniela 2026.png',
                'pais_id' => 2,
            ],
            [
                'posicion' => 2,
                'titulo_posicion' => 'Tercer lugar',
                'nombre' => 'Teatro en casa',
                'imagen' => '/images/premios/es/Premio teatro en casa quiniela 2026.png',
                'pais_id' => 2,
            ],
            [
                'posicion' => 3,
                'titulo_posicion' => 'Cuarto a décimo lugar',
                'nombre' => 'Bocina para karaoke',
                'imagen' => '/images/premios/es/Premio bocina quiniela 2026.png',
                'pais_id' => 2,
            ],
            [
                'posicion' => 4,
                'titulo_posicion' => '11vo al 15vo lugar',
                'nombre' => 'Balón oficial del mundial',
                'imagen' => '/images/premios/es/Premio balon mundial quiniela 2026.png',
                'pais_id' => 2,
            ],
            [
                'posicion' => 5,
                'titulo_posicion' => '16 al 25 lugar',
                'nombre' => 'Camisola de selección participante',
                'imagen' => '/images/premios/es/Premio camisola quiniela 2026.png',
                'pais_id' => 2,
            ],
            [
                'posicion' => 6,
                'titulo_posicion' => '26 al 50 lugar',
                'nombre' => 'Balón de fútbol Med Pharma',
                'imagen' => '/images/premios/es/Premio balon mundial medpharma 2026.png',
                'pais_id' => 2,
            ],

            // Honduras (HN)
            [
                'posicion' => 1,
                'titulo_posicion' => 'Primeros tres lugares',
                'nombre' => "Televisor 43''",
                'imagen' => '/images/premios/hn/Premio TV quiniela 2026.png',
                'pais_id' => 3,
            ],
            [
                'posicion' => 2,
                'titulo_posicion' => 'Siguientes tres lugares',
                'nombre' => 'Barra de sonido',
                'imagen' => '/images/premios/hn/Premio Barra de sonido quiniela 2026.png',
                'pais_id' => 3,
            ],
            [
                'posicion' => 3,
                'titulo_posicion' => 'Siguientes dos lugares',
                'nombre' => 'Refrigerador compacto',
                'imagen' => '/images/premios/hn/Premio refrigerador compacto quiniela 2026.png',
                'pais_id' => 3,
            ],

            // Nicaragua (NI)
            [
                'posicion' => 1,
                'titulo_posicion' => 'Primer lugar',
                'nombre' => "TV 43''",
                'imagen' => '/images/premios/ni/Premio TV quiniela 2026.png',
                'pais_id' => 4,
            ],
            [
                'posicion' => 2,
                'titulo_posicion' => 'Segundo y tercer lugar',
                'nombre' => 'Refrigeradora 3 pies',
                'imagen' => '/images/premios/ni/Premio Refri quiniela 2026.png',
                'pais_id' => 4,
            ],
            [
                'posicion' => 3,
                'titulo_posicion' => 'Cuarto y quinto lugar',
                'nombre' => "TV 32''",
                'imagen' => '/images/premios/ni/Premio TV pequeña quiniela 2026.png',
                'pais_id' => 4,
            ],
            [
                'posicion' => 4,
                'titulo_posicion' => 'Sexto lugar',
                'nombre' => 'Microondas 7p',
                'imagen' => '/images/premios/ni/Microondas premio quiniela 2026.png',
                'pais_id' => 4,
            ],
            [
                'posicion' => 5,
                'titulo_posicion' => 'Séptimo y octavo lugar',
                'nombre' => 'Microondas 6p',
                'imagen' => '/images/premios/ni/Microondas premio quiniela 2026 V2.png',
                'pais_id' => 4,
            ],
            [
                'posicion' => 6,
                'titulo_posicion' => 'Noveno y décimo lugar',
                'nombre' => 'Freidora de aire',
                'imagen' => '/images/premios/ni/Premio freidora de aire quiniela 2026.png',
                'pais_id' => 4,
            ],
            [
                'posicion' => 7,
                'titulo_posicion' => 'Undécimo y duodécimo lugar',
                'nombre' => "Ventilador 16'' 2 en 1",
                'imagen' => '/images/premios/ni/Premio ventilador quiniela 2026.png',
                'pais_id' => 4,
            ],
            [
                'posicion' => 8,
                'titulo_posicion' => 'Decimotercer y decimocuarto lugar',
                'nombre' => 'Licuadora 550 W',
                'imagen' => '/images/premios/ni/Premio licuadora quiniela 2026.png',
                'pais_id' => 4,
            ],
            [
                'posicion' => 9,
                'titulo_posicion' => 'Decimoquinto y decimosexto lugar',
                'nombre' => 'Rasuradora recargable',
                'imagen' => '/images/premios/ni/Premio rasuradora recargable quiniela 2026.png',
                'pais_id' => 4,
            ],
            [
                'posicion' => 10,
                'titulo_posicion' => 'Decimoséptimo y decimoctavo lugar',
                'nombre' => 'Coffee maker 5 tazas',
                'imagen' => '/images/premios/ni/Premio cafetera quiniela 2026.png',
                'pais_id' => 4,
            ],
            [
                'posicion' => 11,
                'titulo_posicion' => 'Decimonoveno a vigésimo primer lugar',
                'nombre' => 'Vajilla apilable',
                'imagen' => '/images/premios/ni/Premio vajilla quiniela 2026.png',
                'pais_id' => 4,
            ],
            [
                'posicion' => 12,
                'titulo_posicion' => 'Vigésimo segundo y vigésimo tercer lugar',
                'nombre' => 'Waflera belga',
                'imagen' => '/images/premios/ni/Premio waflera quiniela 2026.png',
                'pais_id' => 4,
            ],
            [
                'posicion' => 13,
                'titulo_posicion' => 'Vigésimo cuarto y vigésimo quinto lugar',
                'nombre' => 'Licuadora 2 velocidades',
                'imagen' => '/images/premios/ni/Premio licuadora 2 velocidades quiniela 2026.png',
                'pais_id' => 4,
            ],
            [
                'posicion' => 14,
                'titulo_posicion' => 'Vigésimo sexto y vigésimo séptimo lugar',
                'nombre' => 'Arrocera 12 tazas',
                'imagen' => '/images/premios/ni/Premio arrocera quiniela 2026.png',
                'pais_id' => 4,
            ],

            // Costa Rica (CR)
            [
                'posicion' => 1,
                'titulo_posicion' => 'Primeros dos lugares',
                'nombre' => "Televisor 50''",
                'imagen' => '/images/premios/cr/Premio TV quiniela 2026.png',
                'pais_id' => 5,
            ],
            [
                'posicion' => 2,
                'titulo_posicion' => 'Siguientes tres lugares',
                'nombre' => "Televisor 32''",
                'imagen' => '/images/premios/cr/Premio TV pequeña quiniela 2026.png',
                'pais_id' => 5,
            ],
            [
                'posicion' => 3,
                'titulo_posicion' => 'Siguientes cinco lugares',
                'nombre' => 'Parlante',
                'imagen' => '/images/premios/cr/Premio parlante quiniela 2026.png',
                'pais_id' => 5,
            ],
            [
                'posicion' => 4,
                'titulo_posicion' => 'Siguientes cinco lugares',
                'nombre' => 'Alexa Echo Dot 3',
                'imagen' => '/images/premios/cr/Premio alexa quiniela 2026.png',
                'pais_id' => 5,
            ],
            [
                'posicion' => 5,
                'titulo_posicion' => 'Siguientes cinco lugares',
                'nombre' => 'Audífonos',
                'imagen' => '/images/premios/cr/Premio audifonos quiniela 2026.png',
                'pais_id' => 5,
            ],

            // Panamá (PA)
            [
                'posicion' => 1,
                'titulo_posicion' => 'Primer lugar',
                'nombre' => "Televisor 50''",
                'imagen' => '/images/premios/pa/Premio TV quiniela 2026.png',
                'pais_id' => 6,
            ],
            [
                'posicion' => 2,
                'titulo_posicion' => 'Segundo lugar',
                'nombre' => "Televisor 32''",
                'imagen' => '/images/premios/pa/Premio TV pequeña quiniela 2026.png',
                'pais_id' => 6,
            ],
            [
                'posicion' => 3,
                'titulo_posicion' => 'Tercer lugar',
                'nombre' => 'Parlante',
                'imagen' => '/images/premios/pa/Premio parlante quiniela 2026.png',
                'pais_id' => 6,
            ],
        ];

        foreach($premios as $premio) {
            Premio::create($premio);
        }
    }
}
