<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LeadershipType;

class LeadershipTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $types = [
            ['name' => 'University Student Goverment(USG)'],
            ['name' => 'Obrero Student Council(OSC)'],
            ['name' => 'Local Council (LC)'],
            ['name' => 'Student Clubs and Organizations'],
            ['name' => 'Local Government Unit (LGU)'],
        ];

        foreach ($types as $type) {
            LeadershipType::firstOrCreate($type);
        }
    }
}
