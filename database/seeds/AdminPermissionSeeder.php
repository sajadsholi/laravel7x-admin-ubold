<?php

use App\Model\Permission;
use App\Model\Permission_category;
use App\Model\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('permission_categories')->delete();
        DB::table('permissions')->delete();
        DB::table('roles')->delete();

        $category = [
            [
                'name' => 'Definition',
                'priority' => 300
            ],
            [
                'name' => 'User',
                'priority' => 250
            ],
            [
                'name' => 'Notification',
                'priority' => 200
            ],
            [
                'name' => 'Support',
                'priority' => 150
            ],
            [
                'name' => 'Settings',
                'priority' => 100
            ],
            [
                'name' => 'FAQ',
                'priority' => 50
            ],
            [
                'name' => 'Pages',
                'priority' => 0
            ],
        ];

        $permission = [
            [
                'name' => "Add Business Category",
                'key' => 'addBusinessCategory',
                'permission_category_id' => 1,
                'priority' => 1000
            ],
            [
                'name' => "Edit Business Category",
                'key' => 'editBusinessCategory',
                'permission_category_id' => 1,
                'priority' => 950
            ],
            [
                'name' => "Delete Business Category",
                'key' => 'deleteBusinessCategory',
                'permission_category_id' => 1,
                'priority' => 900
            ],
            [
                'name' => "Add Location",
                'key' => 'addLocation',
                'permission_category_id' => 1,
                'priority' => 850
            ],
            [
                'name' => "Edit Location",
                'key' => 'editLocation',
                'permission_category_id' => 1,
                'priority' => 800
            ],
            [
                'name' => "Delete Location",
                'key' => 'deleteLocation',
                'permission_category_id' => 1,
                'priority' => 750
            ],
            [
                'name' => "Manage Users",
                'key' => 'user',
                'permission_category_id' => 2,
                'priority' => 700
            ],
            [
                'name' => "Manage Notification",
                'key' => 'notification',
                'permission_category_id' => 3,
                'priority' => 650
            ],
            [
                'name' => "Manage Support's Ticket",
                'key' => 'support',
                'permission_category_id' => 4,
                'priority' => 600
            ],
            [
                'name' => 'General Settings',
                'key' => 'generalSettings',
                'permission_category_id' => 5,
                'priority' => 550
            ],
            [
                'name' => 'Application Settings',
                'key' => 'applicationSettings',
                'permission_category_id' => 5,
                'priority' => 500
            ],
            [
                'name' => 'Contact Us',
                'key' => 'contactUs',
                'permission_category_id' => 5,
                'priority' => 450
            ],
            [
                'name' => 'About Us',
                'key' => 'aboutUs',
                'permission_category_id' => 5,
                'priority' => 400
            ],
            [
                'name' => 'Terms of Service',
                'key' => 'termsOfService',
                'permission_category_id' => 5,
                'priority' => 350
            ],
            [
                'name' => 'Add FAQ',
                'key' => 'addFaq',
                'permission_category_id' => 6,
                'priority' => 300
            ],
            [
                'name' => 'Edit FAQ',
                'key' => 'editFaq',
                'permission_category_id' => 6,
                'priority' => 250
            ],
            [
                'name' => 'Delete FAQ',
                'key' => 'deleteFaq',
                'permission_category_id' => 6,
                'priority' => 200
            ],
            [
                'name' => 'Add Page',
                'key' => 'addPage',
                'permission_category_id' => 7,
                'priority' => 150
            ],
            [
                'name' => 'Edit Page',
                'key' => 'editPage',
                'permission_category_id' => 7,
                'priority' => 50
            ],
            [
                'name' => 'Delete Page',
                'key' => 'deletePage',
                'permission_category_id' => 7,
                'priority' => 0
            ],
        ];

        Permission_category::insert($category);

        Permission::insert($permission);

        $permission_role = [];
        for ($i = 1; $i <= sizeof($permission); $i++) {
            $permission_role[] = [
                'permission_id' => $i
            ];
        }

        Role::create([
            'name' => 'Head Admin'
        ])->permissions()->sync($permission_role);
    }
}
