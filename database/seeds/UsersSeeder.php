<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user=new User();
        $user->s_id="1";
        $user->name="User 1";
        $user->department="CSE";
        $user->email="a@a.com";
        $user->password=crypt("123456","");
        $user->phone="01234567890";
        $user->save();
    }
}
