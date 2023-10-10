<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::factory()->create();
        Course::factory()->create(['name' => 'MS-CIT']);
        Course::factory()->create(['name' => 'CCC']);
        Course::factory()->create(['name' => 'TALLY']);
    }
}
