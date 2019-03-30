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
        $faculty->f_id="10010";
        $faculty->name="Professor Dr. Touhid Bhuiyan";
        $faculty->department="SWE";
        $faculty->faculty="FSIT";
        $faculty->designation="Professor & Head";
        $faculty->email="tb@faculty.com";
        $faculty->password=crypt("123456","");
        $faculty->phone="01234567890";
        $faculty->photo="/images/default.jpg";
        $faculty->save();
    }
}
