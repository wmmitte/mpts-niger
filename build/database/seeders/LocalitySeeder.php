<?php

namespace Database\Seeders;

use App\Models\Locality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $continents = [
            array(
                'wording' => 'Afrique',
                'type' => 'continent',
                'nationality' => '',
            ),
            array(
                'wording' => 'Amerique',
                'type' => 'continent',
                'nationality' => '',
            ),
            array(
                'wording' => 'Asie',
                'type' => 'continent',
                'nationality' => '',
            ),
            array(
                'wording' => 'Europe',
                'type' => 'continent',
                'nationality' => '',
            ),
        ];
        $countries = [
            array(
                'wording' => 'Burkina Faso',
                'type' => 'country',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Afrique'
            ),
            array(
                'wording' => 'Togo',
                'type' => 'country',
                'nationality' => 'Togolaise',
                'locality_id' =>'Afrique'
            ),
            array(
                'wording' => 'USA',
                'type' => 'country',
                'nationality' => 'Americaine',
                'locality_id' =>'Amerique'
            ),
            array(
                'wording' => 'Ghana',
                'type' => 'country',
                'nationality' => 'Ghaneenne',
                'locality_id' =>'Afrique'
            ),
            array(
                'wording' => 'Nigeria',
                'type' => 'country',
                'nationality' => 'Nigerianne',
                'locality_id' =>'Afrique'
            ),
            array(
                'wording' => 'Niger',
                'type' => 'country',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Afrique'
            ),
            array(
                'wording' => 'Rwanda',
                'type' => 'country',
                'nationality' => 'Rwandaise',
                'locality_id' =>'Afrique'
            ),
        ];

        $regions = [
            //===== Region du Burkina
            array(
                'wording' => 'Centre',
                'type' => 'district',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Burkina Faso'
            ),
            array(
                'wording' => 'Boucle du Mouhoun',
                'type' => 'district',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Burkina Faso'
            ),
            array(
                'wording' => 'Cascades',
                'type' => 'district',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Burkina Faso'
            ),
            array(
                'wording' => 'Centre-Est',
                'type' => 'district',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Burkina Faso'
            ),
            array(
                'wording' => 'Centre-Nord',
                'type' => 'district',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Burkina Faso'
            ),
            array(
                'wording' => 'Centre-Ouest',
                'type' => 'district',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Burkina Faso'
            ),
            array(
                'wording' => 'Centre-Sud',
                'type' => 'district',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Burkina Faso'
            ),
            array(
                'wording' => 'Est',
                'type' => 'district',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Burkina Faso'
            ),
            array(
                'wording' => 'Hauts Bassins',
                'type' => 'district',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Burkina Faso'
            ),
            array(
                'wording' => 'Nord',
                'type' => 'district',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Burkina Faso'
            ),
            array(
                'wording' => 'Plateau Central',
                'type' => 'district',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Burkina Faso'
            ),
            array(
                'wording' => 'Sahel',
                'type' => 'district',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Burkina Faso'
            ),
            array(
                'wording' => 'Sud-Ouest',
                'type' => 'district',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Burkina Faso'
            ),
            //===== Fin region du Burkina
            array(
                'wording' => 'Agadez',
                'type' => 'district',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Niger'
            ),
            array(
                'wording' => 'Diffa',
                'type' => 'district',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Niger'
            ),
            array(
                'wording' => 'Dosso',
                'type' => 'district',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Niger'
            ),
            array(
                'wording' => 'Maradi',
                'type' => 'district',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Niger'
            ),
            array(
                'wording' => 'Niamey',
                'type' => 'district',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Niger'
            ),
            array(
                'wording' => 'Tahoua',
                'type' => 'district',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Niger'
            ),
            array(
                'wording' => 'Tillabéri',
                'type' => 'district',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Niger'
            ),
            array(
                'wording' => 'Zinder',
                'type' => 'district',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Niger'
            ),
            array(
                'wording' => 'Maritime',
                'type' => 'district',
                'nationality' => 'Togolaise',
                'locality_id' =>'Togo'
            ),
        ];

        $cities = [
            //===== DEBUT Villes du Burkina
            array(
                'wording' => 'Ouagadougou',
                'type' => 'city',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Centre'
            ),
            array(
                'wording' => 'Dédougou',
                'type' => 'city',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Boucle du Mouhoun'
            ),
            array(
                'wording' => 'Banfora',
                'type' => 'city',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Cascades'
            ),
            array(
                'wording' => 'Tenkodogo',
                'type' => 'city',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Centre-Est'
            ),
            array(
                'wording' => 'Kaya',
                'type' => 'city',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Centre-Nord'
            ),
            array(
                'wording' => 'Koudougou',
                'type' => 'city',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Centre-Ouest'
            ),
            array(
                'wording' => 'Manga',
                'type' => 'city',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Centre-Sud'
            ),
            array(
                'wording' => 'Fada N\'Gourma',
                'type' => 'city',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Est'
            ),
            array(
                'wording' => 'Bobo-Dioulasso',
                'type' => 'city',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Hauts Bassins'
            ),
            array(
                'wording' => 'Ouahigouya',
                'type' => 'city',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Nord'
            ),
            array(
                'wording' => 'Ziniaré',
                'type' => 'city',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Plateau Central'
            ),
            array(
                'wording' => 'Dori',
                'type' => 'city',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Sahel'
            ),
            array(
                'wording' => 'Gaoua',
                'type' => 'city',
                'nationality' => 'Burkinabè',
                'locality_id' =>'Sud-Ouest'
            ),
            //===== Fin Villes du Burkina
            //===== DEBUT Villes du niger
            array(
                'wording' => 'Niamey',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Niamey'
            ),
            // region agadez
            array(
                'wording' => 'Arlit',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Agadez'
            ),
            array(
                'wording' => 'Tchirozérine',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Agadez'
            ),
            array(
                'wording' => 'Bilma',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Agadez'
            ),
            array(
                'wording' => 'Agadez',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Agadez'
            ),
            // region Diffa
            array(
                'wording' => 'Maïné-Soroa',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Diffa'
            ),
            array(
                'wording' => 'Diffa',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Diffa'
            ),
            array(
                'wording' => 'N\'Guigmi',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Diffa'
            ),
            // region Dosso
            array(
                'wording' => 'Dosso',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Dosso'
            ),
            array(
                'wording' => 'Loga',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Dosso'
            ),
            array(
                'wording' => 'Dogondoutchi',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Dosso'
            ),
            array(
                'wording' => 'Gaya',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Dosso'
            ),
            array(
                'wording' => 'Birni N\'Gaouré',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Dosso'
            ),
            // region Maradi
            array(
                'wording' => 'Tibiri',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Maradi'
            ),
            array(
                'wording' => 'Mayahi',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Maradi'
            ),
            array(
                'wording' => 'Guidan-Roumdji',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Maradi'
            ),
            array(
                'wording' => 'Madarounfa',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Maradi'
            ),
            array(
                'wording' => 'Maradi',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Maradi'
            ),
            array(
                'wording' => 'Dakoro',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Maradi'
            ),
            array(
                'wording' => 'Tessaoua',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Maradi'
            ),
            array(
                'wording' => 'Aguié',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Maradi'
            ),
            // Region Tahoua
            array(
                'wording' => 'Tahoua',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Tahoua'
            ),
            array(
                'wording' => 'Madaoua',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Tahoua'
            ),
            array(
                'wording' => 'Bouza',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Tahoua'
            ),
            array(
                'wording' => 'Kéita',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Tahoua'
            ),
            array(
                'wording' => 'Abalak',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Tahoua'
            ),
            array(
                'wording' => 'Tchintabaraden',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Tahoua'
            ),
            array(
                'wording' => 'Birni N\'Konni',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Tahoua'
            ),
            array(
                'wording' => 'Illéla',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Tahoua'
            ),
            // Region Tillabéri
            array(
                'wording' => 'Téra',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Tillabéri'
            ),
            array(
                'wording' => 'Filingué',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Tillabéri'
            ),
            array(
                'wording' => 'Ouallam',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Tillabéri'
            ),
            array(
                'wording' => 'Say',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Tillabéri'
            ),
            array(
                'wording' => 'Tillabéri',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Tillabéri'
            ),
            array(
                'wording' => 'Kollo',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Tillabéri'
            ),
            // Region Zinder
            array(
                'wording' => 'Magaria',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Zinder'
            ),
            array(
                'wording' => 'Zinder',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Zinder'
            ),
            array(
                'wording' => 'Gouré',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Zinder'
            ),
            array(
                'wording' => 'Mirriah',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Zinder'
            ),
            array(
                'wording' => 'Matamèye',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Zinder'
            ),
            array(
                'wording' => 'Tanout',
                'type' => 'city',
                'nationality' => 'Nigerienne',
                'locality_id' =>'Zinder'
            ),

            //===== FIN villes du niger
            array(
                'wording' => 'Lomé',
                'type' => 'city',
                'nationality' => 'Togolaise',
                'locality_id' => 'Région maritime'
            ),
        ];

        Locality::truncate();
        foreach ($continents as $continent) {
            $continent['ref'] = Str::uuid();
            $continent = Locality::create($continent);
            foreach ($countries as $country) {
                if($country['locality_id'] == $continent->wording) {
                    $country['ref'] = Str::uuid();
                    $country['locality_id'] = $continent->id;
                    $country = Locality::create($country);
                    foreach ($regions as $region) {
                        if($region['locality_id'] == $country->wording) {
                            $region['ref'] = Str::uuid();
                            $region['locality_id'] = $country->id;
                            $region = Locality::create($region);
                            foreach ($cities as $city) {
                                if($city['locality_id'] == $region->wording) {
                                    $city['ref'] = Str::uuid();
                                    $city['locality_id'] = $region->id;
                                    Locality::create($city);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
