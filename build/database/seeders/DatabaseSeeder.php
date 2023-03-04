<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // \App\Models\User::factory(10)->create();
       $this->call([
            EntitySeeder::class,
            UserSeeder::class,
            LocalitySeeder::class,
            GroupLocalitySeeder::class,
            QualificationAreaSeeder::class,
            ProfessionalCategorySeeder::class,
            ActivitySeeder::class,
            EmployerSeeder::class,
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
