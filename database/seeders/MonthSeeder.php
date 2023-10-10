<?php

namespace Database\Seeders;

use App\Models\Month;
use Illuminate\Database\Seeder;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Month::factory()->create();
        Month::factory()->create(['month_name' => 'February']);
        Month::factory()->create(['month_name' => 'March']);
        Month::factory()->create(['month_name' => 'April']);
        Month::factory()->create(['month_name' => 'May']);
        Month::factory()->create(['month_name' => 'June']);
        Month::factory()->create(['month_name' => 'July']);
        Month::factory()->create(['month_name' => 'August']);
        Month::factory()->create(['month_name' => 'September']);
        Month::factory()->create(['month_name' => 'October']);
        Month::factory()->create(['month_name' => 'November']);
        Month::factory()->create(['month_name' => 'December']);

    }
}
