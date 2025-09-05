<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RubricCategory;

class RubricCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'title' => 'Academic Performance',
                'max_points' => 40.00,
                'order_no' => 1,
            ],
            [
                'title' => 'Leadership Skills',
                'max_points' => 25.00,
                'order_no' => 2,
            ],
            [
                'title' => 'Community Service',
                'max_points' => 20.00,
                'order_no' => 3,
            ],
            [
                'title' => 'Research & Innovation',
                'max_points' => 15.00,
                'order_no' => 4,
            ],
        ];

        foreach ($categories as $category) {
            RubricCategory::create($category);
        }
    }
}


