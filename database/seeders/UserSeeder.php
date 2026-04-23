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
                'nombres'          =>  'DEV',
                'apellidos'        =>  'PWG 1',
                'numero_documento' =>  '1234567891111',
                'telefono'         =>  '63443212',
                'email'            =>  'dev@paginawebguatemala.com',
                'pais_id'          =>  1,
                'status_user'      =>  1,
                'puntos'           =>  0,
                'accepted_terms'   => true,
                'password'         =>  Hash::make('FScomunica2'),
                'created_at'       =>  (Carbon::now())->toDateTimeString(),
            ],

            [
                'codigo_id'        =>  2,
                'nombres'          =>  'Medpharma',
                'apellidos'        =>  'User',
                'numero_documento' =>  '1234567891112',
                'telefono'         =>  '63443211',
                'email'            =>  'test@paginawebguatemala.com',
                'pais_id'          =>  1,
                'status_user'      =>  1,
                'puntos'           =>  0,
                'accepted_terms'   =>  true,
                'password'         =>  Hash::make('FScomunica2'),
                'created_at'       =>  (Carbon::now())->toDateTimeString(),
            ],

            [
                'codigo_id'        =>  3,
                'nombres'          =>  'Medpharma',
                'apellidos'        =>  'SV',
                'numero_documento' =>  '1234567891113',
                'telefono'         =>  '63443211',
                'email'            =>  'test2@paginawebguatemala.com',
                'pais_id'          =>  2,
                'status_user'      =>  1,
                'puntos'           =>  0,
                'accepted_terms'   =>  true,
                'password'         =>  Hash::make('FScomunica2'),
                'created_at'       =>  (Carbon::now())->toDateTimeString(),
            ],

            [
                'codigo_id'        =>  4,
                'nombres'          =>  'Medpharma',
                'apellidos'        =>  'HN',
                'numero_documento' =>  '1234567891114',
                'telefono'         =>  '63443211',
                'email'            =>  'test3@paginawebguatemala.com',
                'pais_id'          =>  3,
                'status_user'      =>  1,
                'puntos'           =>  0,
                'accepted_terms'   =>  true,
                'password'         =>  Hash::make('FScomunica2'),
                'created_at'       =>  (Carbon::now())->toDateTimeString(),
            ],

            [
                'codigo_id'        =>  5,
                'nombres'          =>  'Medpharma',
                'apellidos'        =>  'NI',
                'numero_documento' =>  '1234567891115',
                'telefono'         =>  '63443211',
                'email'            =>  'test4@paginawebguatemala.com',
                'pais_id'          =>  4,
                'status_user'      =>  1,
                'puntos'           =>  0,
                'accepted_terms'   =>  true,
                'password'         =>  Hash::make('FScomunica2'),
                'created_at'       =>  (Carbon::now())->toDateTimeString(),
            ],

            [
                'codigo_id'        =>  6,
                'nombres'          =>  'Medpharma',
                'apellidos'        =>  'CR',
                'numero_documento' =>  '1234567891116',
                'telefono'         =>  '63443211',
                'email'            =>  'test5@paginawebguatemala.com',
                'pais_id'          =>  5,
                'status_user'      =>  1,
                'puntos'           =>  0,
                'accepted_terms'   =>  true,
                'password'         =>  Hash::make('FScomunica2'),
                'created_at'       =>  (Carbon::now())->toDateTimeString(),
            ],

            [
                'codigo_id'        =>  7,
                'nombres'          =>  'Medpharma',
                'apellidos'        =>  'PA',
                'numero_documento' =>  '1234567891117',
                'telefono'         =>  '63443211',
                'email'            =>  'test6@paginawebguatemala.com',
                'pais_id'          =>  6,
                'status_user'      =>  1,
                'puntos'           =>  0,
                'accepted_terms'   =>  true,
                'password'         =>  Hash::make('FScomunica2'),
                'created_at'       =>  (Carbon::now())->toDateTimeString(),
            ],
        ];
        
        DB::table('users')->insert($users);
        // User::factory()->count(600)->create();
    }
}
