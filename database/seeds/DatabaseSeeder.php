<?php

use App\Course;
use App\User;
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
        // $this->call(UserSeeder::class);
        $this->call(PriviledgeSeeder::class);
        // $this->call(factory(Course::class)->times(50)->create());
    }
}
