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
        ];
        
        DB::table('users')->insert($users);
        // User::factory()->count(600)->create();
    }
}
