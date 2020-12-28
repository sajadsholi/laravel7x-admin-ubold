<?php

use App\Model\Contact;
use Illuminate\Database\Seeder;

class ContactUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Contact::truncate();

        $data = [
            'contact_number' => '[{"title":"Office number","value":"12345678"}]' ,
            'address' => '[{"title":"Office address","value":"New street 123"}]' ,
            'email' => '[{"title":"Support email","value":"support@test.com"}]' ,
            'lat' => '29.619155227424553',
            'lng' => '52.52942472696305'
        ];

        Contact::create($data);

    }
}
