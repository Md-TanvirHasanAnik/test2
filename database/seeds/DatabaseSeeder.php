<?php

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
        // $this->call(UsersTableSeeder::class);
//         $this->call(StudentsSeeder::class);
//        $this->call(SlotSeeder::class);
        $this->call(FacultySeeder::class);
    }
}
