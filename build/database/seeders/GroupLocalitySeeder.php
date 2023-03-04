<?php

namespace Database\Seeders;

use App\Models\GroupLocality;
use App\Models\Locality;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class GroupLocalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $zones = [
            array(
                'wording' => 'Zone UEMOA',
                'localities' => ['Burkina Faso', 'Togo', 'Niger']
            ),
            array(
                'wording' => 'Zone CEDEAO',
                'localities' => ['Burkina Faso', 'Togo', 'Niger', 'Nigeria']
            ),
        ];

        GroupLocality::truncate();
        foreach ($zones as $zone) {
            $zone['ref'] = Str::uuid();
            $listLocalities = $zone['localities'];
            unset($zone['localities']);
            $group = GroupLocality::create($zone);
            $localities = Locality::whereIn('wording', $listLocalities)->get()->pluck('id');
            // dd($localities);
            $group->localities()->attach($localities);
        }
    }
}
