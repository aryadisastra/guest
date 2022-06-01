<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addUser = new User();
        $addUser->nama = 'Admin';
        $addUser->username = 'admin';
        $addUser->password = sha1(md5(sha1('admin')));
        $addUser->bagian = 1;
        $addUser->save();
    }
}
