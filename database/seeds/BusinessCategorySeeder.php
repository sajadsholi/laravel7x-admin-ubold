<?php

use App\Model\BusinessCategory;
use App\Model\BusinessCategoryTranslation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('business_categories')->delete();
        DB::table('business_category_translations')->delete();
        $lastId = DB::table('media')->latest('id')->first()->id;

        $businessCategory = [
            [
                'id' => 1,
                'parent_id' => NULL,
                'priority' => 10
            ],
            [
                'id' => 2,
                'parent_id' => 1,
                'priority' => 10
            ],
            [
                'id' => 3,
                'parent_id' => 1,
                'priority' => 20
            ],
            [
                'id' => 4,
                'parent_id' => 1,
                'priority' => 30
            ],
            [
                'id' => 5,
                'parent_id' => 1,
                'priority' => 40
            ],
            [
                'id' => 6,
                'parent_id' => NULL,
                'priority' => 20
            ],
            [
                'id' => 7,
                'parent_id' => 6,
                'priority' => 10
            ],
            [
                'id' => 8,
                'parent_id' => 6,
                'priority' => 20
            ],
            [
                'id' => 9,
                'parent_id' => 6,
                'priority' => 30
            ],
            [
                'id' => 10,
                'parent_id' => NULL,
                'priority' => 30
            ],
            [
                'id' => 11,
                'parent_id' => 10,
                'priority' => 10
            ],
            [
                'id' => 12,
                'parent_id' => 10,
                'priority' => 20
            ],
            [
                'id' => 13,
                'parent_id' => NULL,
                'priority' => 40
            ],
            [
                'id' => 14,
                'parent_id' => 13,
                'priority' => 10
            ],
            [
                'id' => 15,
                'parent_id' => 13,
                'priority' => 20
            ],
            [
                'id' => 16,
                'parent_id' => NULL,
                'priority' => 50
            ],
            [
                'id' => 17,
                'parent_id' => 16,
                'priority' => 10
            ],
            [
                'id' => 18,
                'parent_id' => 16,
                'priority' => 20
            ],
            [
                'id' => 19,
                'parent_id' => NULL,
                'priority' => 5
            ],
            [
                'id' => 20,
                'parent_id' => NULL,
                'priority' => 45
            ],
        ];

        $translation = [
            [
                'business_category_id' => 1,
                'locale' => 'en',
                'name' => 'Food',
                'link' => 'Food',
                'meta_title' => 'Food',
                'meta_keywords' => 'Food',
                'meta_description' => 'Food',
            ],
            [
                'business_category_id' => 1,
                'locale' => 'fa',
                'name' => 'غذا',
                'link' => 'غذا',
                'meta_title' => 'غذا',
                'meta_keywords' => 'غذا',
                'meta_description' => 'غذا',
            ],
            [
                'business_category_id' => 2,
                'locale' => 'en',
                'name' => 'Restaurant',
                'link' => 'Restaurant',
                'meta_title' => 'Restaurant',
                'meta_keywords' => 'Restaurant',
                'meta_description' => 'Restaurant',
            ],
            [
                'business_category_id' => 2,
                'locale' => 'fa',
                'name' => 'رستوران',
                'link' => 'رستوران',
                'meta_title' => 'رستوران',
                'meta_keywords' => 'رستوران',
                'meta_description' => 'رستوران',
            ],
            [
                'business_category_id' => 3,
                'locale' => 'en',
                'name' => 'Cafe',
                'link' => 'Cafe',
                'meta_title' => 'Cafe',
                'meta_keywords' => 'Cafe',
                'meta_description' => 'Cafe',
            ],
            [
                'business_category_id' => 3,
                'locale' => 'fa',
                'name' => 'کافه',
                'link' => 'کافه',
                'meta_title' => 'کافه',
                'meta_keywords' => 'کافه',
                'meta_description' => 'کافه',
            ],
            [
                'business_category_id' => 4,
                'locale' => 'en',
                'name' => 'Fast Food',
                'link' => 'Fast Food',
                'meta_title' => 'Fast Food',
                'meta_keywords' => 'Fast Food',
                'meta_description' => 'Fast Food',
            ],
            [
                'business_category_id' => 4,
                'locale' => 'fa',
                'name' => 'فست فود',
                'link' => 'فست فود',
                'meta_title' => 'فست فود',
                'meta_keywords' => 'فست فود',
                'meta_description' => 'فست فود',
            ],
            [
                'business_category_id' => 5,
                'locale' => 'en',
                'name' => 'Catering',
                'link' => 'Catering',
                'meta_title' => 'Catering',
                'meta_keywords' => 'Catering',
                'meta_description' => 'Catering',
            ],
            [
                'business_category_id' => 5,
                'locale' => 'fa',
                'name' => 'بیرون بر',
                'link' => 'بیرون بر',
                'meta_title' => 'بیرون بر',
                'meta_keywords' => 'بیرون بر',
                'meta_description' => 'بیرون بر',
            ],
            [
                'business_category_id' => 6,
                'locale' => 'en',
                'name' => 'Transportation',
                'link' => 'Transportation',
                'meta_title' => 'Transportation',
                'meta_keywords' => 'Transportation',
                'meta_description' => 'Transportation',
            ],
            [
                'business_category_id' => 6,
                'locale' => 'fa',
                'name' => 'حمل و نقل',
                'link' => 'حمل و نقل',
                'meta_title' => 'حمل و نقل',
                'meta_keywords' => 'حمل و نقل',
                'meta_description' => 'حمل و نقل',
            ],
            [
                'business_category_id' => 7,
                'locale' => 'en',
                'name' => 'Taxi Agency',
                'link' => 'Taxi Agency',
                'meta_title' => 'Taxi Agency',
                'meta_keywords' => 'Taxi Agency',
                'meta_description' => 'Taxi Agency',
            ],
            [
                'business_category_id' => 7,
                'locale' => 'fa',
                'name' => 'آژانس تاکسی',
                'link' => 'آژانس تاکسی',
                'meta_title' => 'آژانس تاکسی',
                'meta_keywords' => 'آژانس تاکسی',
                'meta_description' => 'آژانس تاکسی',
            ],
            [
                'business_category_id' => 8,
                'locale' => 'en',
                'name' => 'Car Rental',
                'link' => 'Car Rental',
                'meta_title' => 'Car Rental',
                'meta_keywords' => 'Car Rental',
                'meta_description' => 'Car Rental',
            ],
            [
                'business_category_id' => 8,
                'locale' => 'fa',
                'name' => 'اجاره اتومبیل',
                'link' => 'اجاره اتومبیل',
                'meta_title' => 'اجاره اتومبیل',
                'meta_keywords' => 'اجاره اتومبیل',
                'meta_description' => 'اجاره اتومبیل',
            ],
            [
                'business_category_id' => 9,
                'locale' => 'en',
                'name' => 'Travel Agency',
                'link' => 'Travel Agency',
                'meta_title' => 'Travel Agency',
                'meta_keywords' => 'Travel Agency',
                'meta_description' => 'Travel Agency',
            ],
            [
                'business_category_id' => 9,
                'locale' => 'fa',
                'name' => 'آژانس مسافرتی',
                'link' => 'آژانس مسافرتی',
                'meta_title' => 'آژانس مسافرتی',
                'meta_keywords' => 'آژانس مسافرتی',
                'meta_description' => 'آژانس مسافرتی',
            ],
            [
                'business_category_id' => 10,
                'locale' => 'en',
                'name' => 'Sport',
                'link' => 'Sport',
                'meta_title' => 'Sport',
                'meta_keywords' => 'Sport',
                'meta_description' => 'Sport',
            ],
            [
                'business_category_id' => 10,
                'locale' => 'fa',
                'name' => 'ورزش',
                'link' => 'ورزش',
                'meta_title' => 'ورزش',
                'meta_keywords' => 'ورزش',
                'meta_description' => 'ورزش',
            ],
            [
                'business_category_id' => 11,
                'locale' => 'en',
                'name' => 'Gym',
                'link' => 'Gym',
                'meta_title' => 'Gym',
                'meta_keywords' => 'Gym',
                'meta_description' => 'Gym',
            ],
            [
                'business_category_id' => 11,
                'locale' => 'fa',
                'name' => 'باشگاه',
                'link' => 'باشگاه',
                'meta_title' => 'باشگاه',
                'meta_keywords' => 'باشگاه',
                'meta_description' => 'باشگاه',
            ],
            [
                'business_category_id' => 12,
                'locale' => 'en',
                'name' => 'Trainer',
                'link' => 'Trainer',
                'meta_title' => 'Trainer',
                'meta_keywords' => 'Trainer',
                'meta_description' => 'Trainer',
            ],
            [
                'business_category_id' => 12,
                'locale' => 'fa',
                'name' => 'مربی',
                'link' => 'مربی',
                'meta_title' => 'مربی',
                'meta_keywords' => 'مربی',
                'meta_description' => 'مربی',
            ],
            [
                'business_category_id' => 13,
                'locale' => 'en',
                'name' => 'Health',
                'link' => 'Health',
                'meta_title' => 'Health',
                'meta_keywords' => 'Health',
                'meta_description' => 'Health',
            ],
            [
                'business_category_id' => 13,
                'locale' => 'fa',
                'name' => 'سلامت',
                'link' => 'سلامت',
                'meta_title' => 'سلامت',
                'meta_keywords' => 'سلامت',
                'meta_description' => 'سلامت',
            ],
            [
                'business_category_id' => 14,
                'locale' => 'en',
                'name' => 'Hospital',
                'link' => 'Hospital',
                'meta_title' => 'Hospital',
                'meta_keywords' => 'Hospital',
                'meta_description' => 'Hospital',
            ],
            [
                'business_category_id' => 14,
                'locale' => 'fa',
                'name' => 'بیمارستان',
                'link' => 'بیمارستان',
                'meta_title' => 'بیمارستان',
                'meta_keywords' => 'بیمارستان',
                'meta_description' => 'بیمارستان',
            ],
            [
                'business_category_id' => 15,
                'locale' => 'en',
                'name' => 'Therapist',
                'link' => 'Therapist',
                'meta_title' => 'Therapist',
                'meta_keywords' => 'Therapist',
                'meta_description' => 'Therapist',
            ],
            [
                'business_category_id' => 15,
                'locale' => 'fa',
                'name' => 'درمانگر',
                'link' => 'درمانگر',
                'meta_title' => 'درمانگر',
                'meta_keywords' => 'درمانگر',
                'meta_description' => 'درمانگر',
            ],
            [
                'business_category_id' => 16,
                'locale' => 'en',
                'name' => 'Entertainment',
                'link' => 'Entertainment',
                'meta_title' => 'Entertainment',
                'meta_keywords' => 'Entertainment',
                'meta_description' => 'Entertainment',
            ],
            [
                'business_category_id' => 16,
                'locale' => 'fa',
                'name' => 'سرگرمی',
                'link' => 'سرگرمی',
                'meta_title' => 'سرگرمی',
                'meta_keywords' => 'سرگرمی',
                'meta_description' => 'سرگرمی',
            ],
            [
                'business_category_id' => 17,
                'locale' => 'en',
                'name' => 'Concert',
                'link' => 'Concert',
                'meta_title' => 'Concert',
                'meta_keywords' => 'Concert',
                'meta_description' => 'Concert',
            ],
            [
                'business_category_id' => 17,
                'locale' => 'fa',
                'name' => 'کنسرت',
                'link' => 'کنسرت',
                'meta_title' => 'کنسرت',
                'meta_keywords' => 'کنسرت',
                'meta_description' => 'کنسرت',
            ],
            [
                'business_category_id' => 18,
                'locale' => 'en',
                'name' => 'Exibtion',
                'link' => 'Exibtion',
                'meta_title' => 'Exibtion',
                'meta_keywords' => 'Exibtion',
                'meta_description' => 'Exibtion',
            ],
            [
                'business_category_id' => 18,
                'locale' => 'fa',
                'name' => 'نمایشگاه',
                'link' => 'نمایشگاه',
                'meta_title' => 'نمایشگاه',
                'meta_keywords' => 'نمایشگاه',
                'meta_description' => 'نمایشگاه',
            ],
            [
                'business_category_id' => 19,
                'locale' => 'en',
                'name' => 'Architecture',
                'link' => 'Architecture',
                'meta_title' => 'Architecture',
                'meta_keywords' => 'Architecture',
                'meta_description' => 'Architecture',
            ],
            [
                'business_category_id' => 19,
                'locale' => 'fa',
                'name' => 'معماری',
                'link' => 'معماری',
                'meta_title' => 'معماری',
                'meta_keywords' => 'معماری',
                'meta_description' => 'معماری',
            ],
            [
                'business_category_id' => 20,
                'locale' => 'en',
                'name' => 'Hotel',
                'link' => 'Hotel',
                'meta_title' => 'Hotel',
                'meta_keywords' => 'Hotel',
                'meta_description' => 'Hotel',
            ],
            [
                'business_category_id' => 20,
                'locale' => 'fa',
                'name' => 'هتل',
                'link' => 'هتل',
                'meta_title' => 'هتل',
                'meta_keywords' => 'هتل',
                'meta_description' => 'هتل',
            ],
        ];

        BusinessCategory::insert($businessCategory);
        BusinessCategoryTranslation::insert($translation);

        $media = [];
        $medium_items = [];
        foreach ($translation as $item) {
            if ($item['locale'] == 'en') {

                $lastId++;

                $name = strtolower($item['name']);
                $media[] = [
                    'path' => "public/media/business category/$name.png",
                    'mime_type' => 'image/png',
                    'options' => json_encode(
                        [
                            'subSizes' =>
                            [
                                'thumbnail' => "public/media/business category/$name-150x150.png",
                                'medium' => "public/media/business category/$name-300x300.png",
                            ],
                        ]
                    ),
                    'created_at' => now()
                ];

                $medium_items[] = [
                    'name' => 'business category',
                    'medium_id' => $lastId,
                    'media_item_type' => 'App\Model\BusinessCategory',
                    'media_item_id' => $item['business_category_id']
                ];
            }
        }

        DB::table('media')->insert($media);
        DB::table('medium_items')->insert($medium_items);
    }
}
