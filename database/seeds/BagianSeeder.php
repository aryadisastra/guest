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
        $addBagian = new Bagian();
        $addBagian->nama_bagian = 'Admin';
        $addBagian->save();
    }
}
