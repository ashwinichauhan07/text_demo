<?php

namespace Database\Seeders;

use App\Models\PractisTypeName;
use Illuminate\Database\Seeder;

class PractisTypeNameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PractisTypeName::factory()->create();
        PractisTypeName::factory()->create(['name' => 'SpeedLetter30']);
        PractisTypeName::factory()->create(['name' => 'SpeedStatement30']);
        PractisTypeName::factory()->create(['name' => 'SpeedPassage40']);
        PractisTypeName::factory()->create(['name' => 'SpeedLetter40']);
        PractisTypeName::factory()->create(['name' => 'SpeedStatement40 ']);
        PractisTypeName::factory()->create(['name' => 'SpeedEmail30 ']);
        PractisTypeName::factory()->create(['name' => 'SpeedEmail40 ']);
    }
}
