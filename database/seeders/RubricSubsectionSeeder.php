<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RubricSubsection;

class RubricSubsectionSeeder extends Seeder
{
    public function run(): void
    {
        RubricSubsection::factory()->create([
            'section_id' => 1,
            'sub_section' => 'Completeness',
            'evidence_needed' => 'Upload PDF evidence',
            'order_no' => 1,
        ]);
    }
}
