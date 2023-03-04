<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Activity;

class ActivitySeeder extends Seeder
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
                'wording' => 'Agriculture',
                'secteur' => 'primaire',
            ),
           array(
                'wording' => 'Industries extractives',
                'secteur' => 'primaire',
            ),
           array(
                'wording' => 'Industries Manufacturières',
                'secteur' => 'primaire',
            ),
           array(
                'wording' => 'Eaux - Electricité Gaz',
                'secteur' => 'primaire',
            ),
           array(
                'wording' => 'Bâtiment et Travaux Publiques',
                'secteur' => 'primaire',
            ),
           array(
                'wording' => 'Commerce - Hotel - Restaurant',
                'secteur' => 'primaire',
            ),
           array(
                'wording' => 'Banques Assurance et affaires imm',
                'secteur' => 'primaire',
            ),
           array(
                'wording' => 'Transport et Communication',
                'secteur' => 'primaire',
            ),
           array(
                'wording' => 'Service Sociaux',
                'secteur' => 'primaire',
            ),
        ];

        Activity::truncate();
        foreach ($objs as $obj) {
            $obj['ref'] = Str::uuid();
            Activity::create($obj);
        }
    }
}
