<?php

use App\Model\Device;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('devices')->delete();

        $data = [
            [
                'name' => 'Android',
                'has_update' => 1,
                'adminClass' => 'p-2 badge badge-success',
                'webClass' => 'p-2 badge badge-success',
            ],
            [
                'name' => 'IOS',
                'has_update' => 1,
                'adminClass' => 'p-2 badge badge-dark',
                'webClass' => 'p-2 badge badge-dark',
            ],
            [
                'name' => 'PWA',
                'has_update' => 0,
                'adminClass' => 'p-2 badge badge-blue',
                'webClass' => 'p-2 badge badge-blue',
            ],
            [
                'name' => 'Web',
                'has_update' => 0,
                'adminClass' => 'p-2 badge badge-pink',
                'webClass' => 'p-2 badge badge-pink',
            ],
            [
                'name' => 'Admin',
                'has_update' => 0,
                'adminClass' => 'p-2 badge badge-primary',
                'webClass' => 'p-2 badge badge-primary',
            ],
        ];

        Device::insert($data);
    }
}
