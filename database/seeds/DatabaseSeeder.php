<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // location
        $this->call(CountrySeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(CitySeederPartOne::class);
        $this->call(CitySeederPartTwo::class);
        $this->call(CitySeederPartThree::class);
        $this->call(CitySeederPartFour::class);
        $this->call(CitySeederPartFive::class);
        $this->call(CitySeederPartSix::class);

        $this->call(LanguageSeeder::class);

        $this->call(SettingSeeder::class);

        // permission and role
        $this->call(AdminPermissionSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(DeviceSeeder::class);
        $this->call(SupportStatusSeeder::class);


        // settings
        $this->call(ContactUsSeeder::class);
        // $this->call(AboutUsSeeder::class);

        $this->call(BusinessCategorySeeder::class);
    }
}
