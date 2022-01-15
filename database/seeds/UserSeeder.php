<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class)->times(200)->create();
        User::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'Abdalrhman Hussin',
                'email' => 'abdalrhmanhussin@gmail.com',
                'password' => Hash::make('password'),
                'active'   => true,
                'grade'    => null,
                'join_date' => Carbon::now(),
                'avatar'    => 'default.png',
                'type'     => config('constant.CREW')
            ]
        );
    }
}
