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
        $user = ['data' => ['akun' => 'admin','bagian' => 1],
                           ['akun' => 'verifikator','bagian' => 2],
                           ['akun' => 'operator','bagian' => 3],
                           ['akun' => 'inspector','bagian' => 4],
                ];

        foreach ($user as $dt)
        {
            $addUser = new User();
            $addUser->nama = ucwords($dt['akun']);
            $addUser->username = $dt['akun'];
            $addUser->password = sha1(md5(sha1($dt['akun'])));
            $addUser->bagian = $dt['bagian'];
            $addUser->save();
        }
    }
}
