<?php

use App\Model\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();

        $data = [
            'firstname' => 'firstname',
            'lastname' => 'lastname',
            'username' => 'admin',
            'password' => Hash::make('123'),
            'lockout_time' => 0,
            // 'role_id' => 1
        ];

        Admin::create($data);
    }
}
