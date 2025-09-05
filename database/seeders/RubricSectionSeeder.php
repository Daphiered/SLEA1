<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RubricSection;

class RubricSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'section_id' => 'SEC001',
                'category_id' => 'CAT001',
                'section_name' => 'Grade Point Average',
                'description' => 'Evaluation based on overall academic performance',
                'max_score' => 100.0,
                'date_created' => now()->subDays(30),
            ],
            [
                'section_id' => 'SEC002',
                'category_id' => 'CAT001',
                'section_name' => 'Class Participation',
                'description' => 'Assessment of active participation in class activities',
                'max_score' => 50.0,
                'date_created' => now()->subDays(25),
            ],
            [
                'section_id' => 'SEC003',
                'category_id' => 'CAT002',
                'section_name' => 'Student Organization Leadership',
                'description' => 'Leadership roles in student organizations',
                'max_score' => 75.0,
                'date_created' => now()->subDays(20),
            ],
            [
                'section_id' => 'SEC004',
                'category_id' => 'CAT002',
                'section_name' => 'Project Management',
                'description' => 'Ability to lead and manage projects effectively',
                'max_score' => 60.0,
                'date_created' => now()->subDays(15),
            ],
            [
                'section_id' => 'SEC005',
                'category_id' => 'CAT003',
                'section_name' => 'Volunteer Hours',
                'description' => 'Community service and volunteer work',
                'max_score' => 40.0,
                'date_created' => now()->subDays(10),
            ],
            [
                'section_id' => 'SEC006',
                'category_id' => 'CAT004',
                'section_name' => 'Research Publications',
                'description' => 'Published research papers and contributions',
                'max_score' => 80.0,
                'date_created' => now()->subDays(5),
            ],
        ];

        foreach ($sections as $section) {
            RubricSection::create($section);
        }
    }
}






