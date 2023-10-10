<?php

namespace Database\Seeders;

use App\Models\Isession;
use Illuminate\Database\Seeder;

class IsessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Isession::factory()->create();
        Isession::factory()->create([
            'start_session' => '6',
            'end_session' => '12'
        ]);
    }
}
