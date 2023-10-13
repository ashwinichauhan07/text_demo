<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserTableSeeder::class);
//        $this->call(AdminSeeder::class);
        $this->call(PractisTypeNameTableSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(IsessionSeeder::class);
        $this->call(DocumentSeeder::class);
//        $this->call(Studenttypesedder::class);
        $this->call(MonthSeeder::class);
    }
}
