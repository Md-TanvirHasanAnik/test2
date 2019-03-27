<?php

use App\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faculty=new Faculty();
        $faculty->f_id="1002";
        $faculty->name="Md Reduanul Haque";
        $faculty->department="CSE";
        $faculty->faculty="FSIT";
        $faculty->designation="Lecturer";
        $faculty->email="r@faculty.com";
        $faculty->password=crypt("123456","");
        $faculty->phone="01234567890";
        $faculty->photo="/images/default.jpg";
        $faculty->save();
    }
}
