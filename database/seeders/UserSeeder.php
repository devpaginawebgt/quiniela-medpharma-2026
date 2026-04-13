<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'codigo_id'        =>  1,
                'nombres'          =>  'Dennis',
                'apellidos'        =>  'PWG',
                'numero_documento' =>  '1234567891111',
                'telefono'         =>  '63443212',
                'email'            =>  'dev@paginawebguatemala.com',
                'pais_id'          =>  1,
                'status_user'      =>  1,
                'puntos'           =>  0,
                'accepted_terms' => true,
                'password'         =>  Hash::make('FScomunica2'),
                'created_at'       =>  (Carbon::now())->toDateTimeString(),
            ],

            [
                'codigo_id'        =>  2,
                'nombres'          =>  'Dwight',
                'apellidos'        =>  'PWG',
                'numero_documento' =>  '1234567891112',
                'telefono'         =>  '63443212',
                'email'            =>  'app@paginawebguatemala.com',
                'pais_id'          =>  1,
                'status_user'      =>  1,
                'puntos'           =>  0,
                'accepted_terms' => true,
                'password'         =>  Hash::make('FScomunica2'),
                'created_at'       =>  (Carbon::now())->toDateTimeString(),
            ],

            [
                'codigo_id'        =>  13,
                'nombres'          =>  'Revisor',
                'apellidos'        =>  'Uno',
                'numero_documento' =>  '1234567891113',
                'telefono'         =>  '39987867',
                'email'            =>  'revisor@email.com',
                'pais_id'          =>  1,
                'status_user'      =>  1,
                'puntos'           =>  0,
                'accepted_terms' => true,
                'password'         =>  Hash::make('FScomunica2'),
                'created_at'       =>  (Carbon::now())->toDateTimeString(),
            ],

            [
                'codigo_id'        =>  14,
                'nombres'          =>  'Revisor',
                'apellidos'        =>  'Dos',
                'numero_documento' =>  '1234567891114',
                'telefono'         =>  '83323462',
                'email'            =>  'revisorios@email.com',
                'pais_id'          =>  1,
                'status_user'      =>  1,
                'puntos'           =>  0,
                'accepted_terms' => true,
                'password'         =>  Hash::make('FScomunica2'),
                'created_at'       =>  (Carbon::now())->toDateTimeString(),
            ],
        ];

        DB::table('users')->insert($users);

        // User::factory()->count(600)->create();
    }
}
