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
                'name' => 'Chinese',
                'language' => 'zh',
                'direction' => 'ltr',
                'is_default' => 0,
                'priority' => 100,
                'deleted_at' => NULL,
                'created_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Spanish',
                'language' => 'es',
                'direction' => 'ltr',
                'is_default' => 0,
                'priority' => 95,
                'deleted_at' => NULL,
                'created_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'English',
                'language' => 'en',
                'direction' => 'ltr',
                'is_default' => 1,
                'priority' => 90,
                'deleted_at' => NULL,
                'created_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Hindi',
                'language' => 'hi',
                'direction' => 'ltr',
                'is_default' => 0,
                'priority' => 85,
                'deleted_at' => NULL,
                'created_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Portuguese',
                'language' => 'pt',
                'direction' => 'ltr',
                'is_default' => 0,
                'priority' => 80,
                'deleted_at' => NULL,
                'created_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Russian',
                'language' => 'ru',
                'direction' => 'ltr',
                'is_default' => 0,
                'priority' => 75,
                'deleted_at' => NULL,
                'created_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'Japanese',
                'language' => 'ja',
                'direction' => 'ltr',
                'is_default' => 0,
                'priority' => 70,
                'deleted_at' => NULL,
                'created_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'Korean',
                'language' => 'ko',
                'direction' => 'ltr',
                'is_default' => 0,
                'priority' => 65,
                'deleted_at' => NULL,
                'created_at' => now(),
            ],
            [
                'id' => 9,
                'name' => 'Turkish',
                'language' => 'tr',
                'direction' => 'ltr',
                'is_default' => 0,
                'priority' => 60,
                'deleted_at' => NULL,
                'created_at' => now(),
            ],
            [
                'id' => 10,
                'name' => 'French',
                'language' => 'fr',
                'direction' => 'ltr',
                'is_default' => 0,
                'priority' => 55,
                'deleted_at' => NULL,
                'created_at' => now(),
            ],
            [
                'id' => 11,
                'name' => 'German',
                'language' => 'de',
                'direction' => 'ltr',
                'is_default' => 0,
                'priority' => 50,
                'deleted_at' => NULL,
                'created_at' => now(),
            ],
            [
                'id' => 12,
                'name' => 'Italian',
                'language' => 'it',
                'direction' => 'ltr',
                'is_default' => 0,
                'priority' => 45,
                'deleted_at' => NULL,
                'created_at' => now(),
            ],
            [
                'id' => 13,
                'name' => 'فارسی',
                'language' => 'fa',
                'direction' => 'rtl',
                'is_default' => 0,
                'priority' => 40,
                'deleted_at' => NULL,
                'created_at' => now(),
            ],
            [
                'id' => 14,
                'name' => 'العربية',
                'language' => 'ar',
                'direction' => 'rtl',
                'is_default' => 0,
                'priority' => 35,
                'deleted_at' => NULL,
                'created_at' => now(),
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
                'medium_id' => 44,
                'media_item_type' => 'App\Model\Language',
                'media_item_id' => 1
            ],
            [
                'name' => 'flag',
                'medium_id' => 205,
                'media_item_type' => 'App\Model\Language',
                'media_item_id' => 2
            ],
            [
                'name' => 'flag',
                'medium_id' => 230,
                'media_item_type' => 'App\Model\Language',
                'media_item_id' => 3
            ],
            [
                'name' => 'flag',
                'medium_id' => 101,
                'media_item_type' => 'App\Model\Language',
                'media_item_id' => 4
            ],
            [
                'name' => 'flag',
                'medium_id' => 176,
                'media_item_type' => 'App\Model\Language',
                'media_item_id' => 5
            ],
            [
                'name' => 'flag',
                'medium_id' => 181,
                'media_item_type' => 'App\Model\Language',
                'media_item_id' => 6
            ],
            [
                'name' => 'flag',
                'medium_id' => 109,
                'media_item_type' => 'App\Model\Language',
                'media_item_id' => 7
            ],
            [
                'name' => 'flag',
                'medium_id' => 116,
                'media_item_type' => 'App\Model\Language',
                'media_item_id' => 8
            ],
            [
                'name' => 'flag',
                'medium_id' => 223,
                'media_item_type' => 'App\Model\Language',
                'media_item_id' => 9
            ],
            [
                'name' => 'flag',
                'medium_id' => 75,
                'media_item_type' => 'App\Model\Language',
                'media_item_id' => 10
            ],
            [
                'name' => 'flag',
                'medium_id' => 82,
                'media_item_type' => 'App\Model\Language',
                'media_item_id' => 11
            ],
            [
                'name' => 'flag',
                'medium_id' => 107,
                'media_item_type' => 'App\Model\Language',
                'media_item_id' => 12
            ],
            [
                'name' => 'flag',
                'medium_id' => 103,
                'media_item_type' => 'App\Model\Language',
                'media_item_id' => 13
            ],
            [
                'name' => 'flag',
                'medium_id' => 247,
                'media_item_type' => 'App\Model\Language',
                'media_item_id' => 14
            ],
        ];

        DB::table('media')->insert($media);
        DB::table('medium_items')->insert($medium_items);
    }
}
