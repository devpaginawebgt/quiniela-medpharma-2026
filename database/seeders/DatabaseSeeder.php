<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CountrySeeder::class,
            CodigoSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            BannerSeeder::class,

            ApiTeamSeeder::class,

            GrupoSeeder::class,
            EquipoSeeder::class,
            EstadioSeeder::class,
            JornadaSeeder::class,
            PartidoSeeder::class,
            EquipoPartidoSeeder::class,
            PremioSeeder::class,
            PrediccionSeeder::class,
            ResultadoPartidoSeeder::class,
            // CompanySeeder::class,
            // BrandSeeder::class,
            // BrandPositionSeeder::class,
            // TermSeeder::class,
            // ModuleSeeder::class,
            // VisitorSeeder::class,
            // UserTypeSeeder::class,
            // QuizSeeder::class,
            // QuizQuestionSeeder::class,
            // QuizOptionSeeder::class,
            // QuizUserSeeder::class,
            // QuizResponseSeeder::class,
        ]);
    }
}
