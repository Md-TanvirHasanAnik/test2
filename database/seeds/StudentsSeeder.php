<?php

use App\Student;
use Illuminate\Database\Seeder;
use App\User;

class StudentsSeeder extends Seeder
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
        $user->s_id="152-15-531";
        $user->name="Nahid Mia";
        $user->department="CSE";
        $user->email="nahid@student.com";
        $user->password=crypt("123456","");
        $user->phone="01234567890";
        $user->photo="/images/default.jpg";
        $user->save();
    }
}
