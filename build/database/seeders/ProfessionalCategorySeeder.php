<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\ProfessionalCategory;

class ProfessionalCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objs = [
           array(
                'wording' => 'Manoeuvres',
            ),
            array(
             'wording' => 'Ouvriers spécialisés',
            ),
            array(
                'wording' => 'Ouvriers qualifiés',
            ),
            array(
                'wording' => 'Agents de maîtrise et techniciens',
            ),

            array(
                'wording' => 'Ingénieurs, cadres supérieurs',
            ),
        ];

        ProfessionalCategory::truncate();
        foreach ($objs as $obj) {
            $obj['ref'] = Str::uuid();
            ProfessionalCategory::create($obj);
        }
    }
}
