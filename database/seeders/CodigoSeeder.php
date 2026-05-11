<?php

namespace Database\Seeders;

use App\Models\Codigo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CodigoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Códigos para usuarios Medpharma por país (ver UserSeeder)
        $medpharmaCodigos = [
            ['codigo' => 'MEDPHAGT', 'country_id' => 1],
            ['codigo' => 'MEDPHASV', 'country_id' => 1],            
        ];

        $nowMedpharma = now();

        DB::table('codigos')->insert(array_map(fn ($item) => [
            'codigo'     => $item['codigo'],
            'country_id' => $item['country_id'],
            'estado'     => 1,
            'created_at' => $nowMedpharma,
            'updated_at' => $nowMedpharma,
        ], $medpharmaCodigos));

        $codigos = require __DIR__ . '/data/codigos.php';

        $now = now();

        foreach (array_chunk($codigos, 500) as $chunk) {
            $registros = array_map(fn ($item) => [
                'codigo' => $item['codigo'],
                'country_id' => $item['country_id'],
                'estado' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ], $chunk);

            DB::table('codigos')->insert($registros);
        }
    }
}
