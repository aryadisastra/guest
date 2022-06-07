<?php

use App\Bagian;
use Illuminate\Database\Seeder;

class BagianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bagian = ['admin','verifikator','operator','inspector'];

        foreach($bagian as $dt)
        {
            $addBagian = new Bagian();
            $addBagian->nama_bagian = $dt;
            $addBagian->save();
        }
    }
}
