<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Employer;

class EmployerSeeder extends Seeder
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
                'raison_social' => 'SONGO TECHNOLOGIES SARL',
                'phone' => '[226]',
                'email' => 'contact@songo-technologies.com',
                'web_site' => 'https://www.songo-technologies.com',
                'mailbox' => '10000',
                'etat' => 'actif',
                'quarter' => 'Cissin Ouaga BF',
                'is_verifed' => true,
                'logo' => 'logo',
                'locality_id' => 4,
                'state' => true,
                'industry_id' => 1

          ),
           array(
                'raison_social' => 'EMERZONE SA',
                'phone' => '[227]',
                'email' => 'contact@emerzone.com',
                'web_site' => 'https://www.emerzone.com',
                'mailbox' => '10000',
                'etat' => 'actif',
                'quarter' => 'Niger niamey 2',
                'is_verifed' => true,
                'logo' => 'logo',
                'locality_id' => 4,
                'state' => true,
                'industry_id' => 1

            ),
           array(
                'raison_social' => 'QUANTUM TECHNOLOGIES',
                'phone' => '[226]',
                'email' => 'contact@quantum-technologies.com',
                'web_site' => 'https://www.quantum-technologies.com',
                'mailbox' => '10000',
                'etat' => 'actif',
                'quarter' => 'Patte d\'oie Ouaga BF',
                'is_verifed' => true,
                'logo' => 'logo',
                'locality_id' => 4,
                'state' => true,
                'industry_id' => 1

            ),

        ];

        Employer::truncate();
        foreach ($objs as $obj) {
            $obj['ref'] = Str::uuid();
            Employer::create($obj);
        }
    }
}
