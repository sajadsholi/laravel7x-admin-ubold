<?php

use App\Model\Support_status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupportStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('support_statuses')->delete();

        $data = [
            [
                'name' => 'Pending',
                'adminClass' => 'p-2 badge badge-warning',
                'webClass' => 'p-2 badge badge-warning',
            ],
            [
                'name' => 'Support Response',
                'adminClass' => 'p-2 badge badge-success',
                'webClass' => 'p-2 badge badge-success',
            ],
            [
                'name' => 'User Response',
                'adminClass' => 'p-2 badge badge-blue',
                'webClass' => 'p-2 badge badge-blue',
            ],
            [
                'name' => 'Closed',
                'adminClass' => 'p-2 badge badge-pink',
                'webClass' => 'p-2 badge badge-pink',
            ],
        ];

        Support_status::insert($data);
    }
}
