<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::factory()->create();
        Subject::factory()->create(['name' => 'English 40 WPM']);
        Subject::factory()->create(['name' => 'Marathi 30 WPM']);
        Subject::factory()->create(['name' => 'Marathi 40 WPM']);
        Subject::factory()->create(['name' => 'Hindi 30 WPM']);
        Subject::factory()->create(['name' => 'Hindi 40 WPM']);
        Subject::factory()->create(['name' => 'GCC-SSD-CTC']);
        Subject::factory()->create(['course_id' => '2', 'name' => 'MS-CIT']);
        Subject::factory()->create(['course_id' => '3', 'name' => 'CCC']);
        Subject::factory()->create(['course_id' => '4', 'name' => 'TALLY']);
    }
}
