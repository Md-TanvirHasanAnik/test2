<?php

use App\TimeSlot;
use Illuminate\Database\Seeder;

class SlotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $slot=new TimeSlot();
        $slot->slot="08:30";
        $slot->type="regular";
        $slot->save();

        $slot1=new TimeSlot();
        $slot1->slot="10:00";
        $slot1->type="regular";
        $slot1->save();

        $slot2=new TimeSlot();
        $slot2->slot="11:30";
        $slot2->type="regular";
        $slot2->save();

        $slot3=new TimeSlot();
        $slot3->slot="01:00";
        $slot3->type="regular";
        $slot3->save();

        $slot4=new TimeSlot();
        $slot4->slot="02:30";
        $slot4->type="regular";
        $slot4->save();

        $slot5=new TimeSlot();
        $slot5->slot="04:00";
        $slot5->type="regular";
        $slot5->save();
    }
}
