<?php

use App\Student;
use Illuminate\Database\Seeder;
use App\User;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user=new Student();
        $user->s_id="152-15-556";
        $user->name="Ahad Kabir";
        $user->department="CSE";
        $user->email="ahad@student.com";
        $user->password=crypt("123456","");
        $user->phone="01234567890";
        $user->photo="/images/default.jpg";
        $user->save();
    }
}
