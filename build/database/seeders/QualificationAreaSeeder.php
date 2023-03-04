<?php

namespace Database\Seeders;

use App\Models\Entity;
use App\Models\QualificationArea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QualificationAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //
        $objs = [
            array(
                'wording' => 'Bâtiment',
            ),
            array(
             'wording' => 'Mécanique',
            ),
            array(
                'wording' => 'Menuiserie',
            ),
            array(
                'wording' => 'Plomberie',
            ),

            array(
                'wording' => 'Electricité',
            ),
            array(
                'wording' => 'Agriculture-Elevage',
            ),
            array(
                'wording' => 'Comptabilité',
            ),
            array(
                'wording' => 'Informatique',
            ),
            array(
                'wording' => 'Commerce',
            ),
            array(
                'wording' => 'Autres filières',
            ),
        ];

        QualificationArea::truncate();
        foreach ($objs as $obj) {
            $obj['ref'] = Str::uuid();
            QualificationArea::create($obj);
        }
    }
}
