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
        $faculty->f_id="11";
        $faculty->name="Faculty 1";
        $faculty->dept="CSE";
        $faculty->designation="Lecturer";
        $faculty->email="b@b.com";
        $faculty->password=crypt("123456","");
        $faculty->phone="01234567890";
        $faculty->save();
    }
}
