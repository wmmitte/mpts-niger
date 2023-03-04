<?php

namespace Database\Seeders;

use App\Models\Entity;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $sg = Entity::where('wording', 'SG Ministère')->first();
        $dge = Entity::where('wording', 'Direction general de l\'emploie')->first();
        $daes = Entity::where('wording', 'DAEP/SMMO Ministère')->first();
        $ministère = Entity::where('wording', 'Ministère')->first();

        $users = [
            array(
                'firstname' => 'Chef',
                'lastname' => 'DAES',
                'email' => 'chef.daes@metps.ne',
                'password' => bcrypt("password"),
                'role' => 'agent',
                'email_verified_at' => now(),
                'is_update_password' => true,
                'entity_id' => $daes->id,
            ),
            array(
                'firstname' => 'Directeur',
                'lastname' => 'DAES',
                'email' => 'directeur.daes@metps.ne',
                'password' => bcrypt("password"),
                'role' => 'directeur',
                'email_verified_at' => now(),
                'is_update_password' => true,
                'entity_id' => $daes->id,
            ),
            array(
                'firstname' => 'directeur',
                'lastname' => 'DGE',
                'email' => 'directeur.dge@metps.ne',
                'password' => bcrypt("password"),
                'role' => 'directeur',
                'email_verified_at' => now(),
                'is_update_password' => true,
                'entity_id' => $dge->id,
            ),
            array(
                'firstname' => 'Sg',
                'lastname' => 'SG',
                'email' => 'sg.sg@metps.ne',
                'password' => bcrypt("password"),
                'role' => 'directeur',
                'email_verified_at' => now(),
                'is_update_password' => true,
                'entity_id' => $sg->id,
            ),
            array(
                'firstname' => 'Cabinet',
                'lastname' => 'Ministre',
                'email' => 'cabinet.ministre@metps.ne',
                'password' => bcrypt("password"),
                'role' => 'general',
                'email_verified_at' => now(),
                'is_update_password' => true,
                'entity_id' => $ministère->id,
            ),
            array(
                'firstname' => 'admin',
                'lastname' => 'admin',
                'email' => 'admin@metps.ne',
                'password' => bcrypt("password"),
                'role' => 'admin',
                'email_verified_at' => now(),
                'is_update_password' => true,
                'entity_id' => $ministère->id,
            ),
            array(
                'firstname' => 'super',
                'lastname' => 'super',
                'email' => 'super@emploie.ng',
                'password' => bcrypt("aRU9KVjQ2HjCgsK3"),
                'role' => 'super',
                'email_verified_at' => now(),
                'is_update_password' => true,
                'entity_id' => $ministère->id,
            )
        ];

        User::truncate();
        foreach ($users as $user) {
            $user['ref'] = Str::uuid();
            User::create($user);
        }
    }
}
