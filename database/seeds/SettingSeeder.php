<?php

use App\Model\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings');

        Setting::insert([
            [
                'key' => 'logo',
                'value' => '',
            ],
            [
                'key' => 'name',
                'value' => env('APP_NAME'),
            ],
            [
                'key' => 'sourceName',
                'value' => 'Atriatech',
            ],
            [
                'key' => 'sourceLink',
                'value' => 'https://atriatech.ir',
            ],
            [
                'key' => 'sourceAboutLink',
                'value' => 'https://atriatech.ir/درباره-طراحی-سایت-آتریاتک',
            ],
            [
                'key' => 'sourceContactLink',
                'value' => 'https://atriatech.ir/تماس-با-طراحی-سایت-آتریاتک',
            ],
            [
                'key' => 'sourceStartYear',
                'value' => '2018',
            ],
        ]);
    }
}
