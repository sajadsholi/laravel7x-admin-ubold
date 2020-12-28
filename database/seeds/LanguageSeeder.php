<?php

use App\Model\Language;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->delete();

        Language::insert([
            [
                'id' => 1,
                'name' => 'فارسی',
                'language' => 'fa',
                'direction' => 'rtl',
                'is_default' => 0,
                'priority' => 30,
            ],
            [
                'id' => 2,
                'name' => 'English',
                'language' => 'en',
                'direction' => 'ltr',
                'is_default' => 1,
                'priority' => 20,
            ],
            [
                'id' => 3,
                'name' => 'العربية',
                'language' => 'ar',
                'direction' => 'rtl',
                'is_default' => 0,
                'priority' => 10,
            ],
        ]);

        $media = [
            [
                'path' => "public/media/flags/arabic.png",
                'mime_type' => 'image/png'
            ]
        ];

        $medium_items = [
            [
                'name' => 'flag',
                'medium_id' => 103,
                'media_item_type' => 'App\Model\Language',
                'media_item_id' => 1
            ],
            [
                'name' => 'flag',
                'medium_id' => 230,
                'media_item_type' => 'App\Model\Language',
                'media_item_id' => 2
            ],
            [
                'name' => 'flag',
                'medium_id' => 247,
                'media_item_type' => 'App\Model\Language',
                'media_item_id' => 3
            ],
        ];

        DB::table('media')->insert($media);
        DB::table('medium_items')->insert($medium_items);
    }
}
