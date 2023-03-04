<?php

namespace Database\Seeders;

use App\Models\Entity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $entities = [
            array(
                'wording' => 'ANPE',
                'state' => false
            ),
            array(
                'wording' => 'Ministère',
            ),
            // array(
            //     'wording' => 'Service courrier ANPE',
            //     'entity_id' => 1,
            //     'state' => false
            // ),
            // array(
            //     'wording' => 'Service contrats ANPE',
            //     'entity_id' => 1,
            //     'state' => false
            // ),
            // array(
            //     'wording' => 'Service operations ANPE',
            //     'entity_id' => 1,
            //     'state' => false
            // ),
            // array(
            //     'wording' => 'Service Informatique',
            //     'entity_id' => 2,
            // ),
            array(
                'wording' => 'Direction general de l\'emploie',
                'entity_id' => 2,
            ),
            array(
                'wording' => 'DAEP/SMMO Ministère',
                'entity_id' => 2,
            ),
            array(
                'wording' => 'SG Ministère',
                'entity_id' => 2,
            ),
        ];

        Entity::truncate();
        foreach ($entities as $entity) {
            $entity['ref']=Str::uuid();
            $entity['slug']=Str::slug($entity['wording']);
            Entity::create($entity);
        }
    }

}
