<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'boat_create',
            ],
            [
                'id'    => 18,
                'title' => 'boat_edit',
            ],
            [
                'id'    => 19,
                'title' => 'boat_show',
            ],
            [
                'id'    => 20,
                'title' => 'boat_delete',
            ],
            [
                'id'    => 21,
                'title' => 'boat_access',
            ],
            [
                'id'    => 22,
                'title' => 'address_create',
            ],
            [
                'id'    => 23,
                'title' => 'address_edit',
            ],
            [
                'id'    => 24,
                'title' => 'address_show',
            ],
            [
                'id'    => 25,
                'title' => 'address_delete',
            ],
            [
                'id'    => 26,
                'title' => 'address_access',
            ],
            [
                'id'    => 27,
                'title' => 'sticker_create',
            ],
            [
                'id'    => 28,
                'title' => 'sticker_edit',
            ],
            [
                'id'    => 29,
                'title' => 'sticker_show',
            ],
            [
                'id'    => 30,
                'title' => 'sticker_delete',
            ],
            [
                'id'    => 31,
                'title' => 'sticker_access',
            ],
            [
                'id'    => 32,
                'title' => 'payment_create',
            ],
            [
                'id'    => 33,
                'title' => 'payment_edit',
            ],
            [
                'id'    => 34,
                'title' => 'payment_show',
            ],
            [
                'id'    => 35,
                'title' => 'payment_delete',
            ],
            [
                'id'    => 36,
                'title' => 'payment_access',
            ],
            [
                'id'    => 37,
                'title' => 'reservation_create',
            ],
            [
                'id'    => 38,
                'title' => 'reservation_edit',
            ],
            [
                'id'    => 39,
                'title' => 'reservation_show',
            ],
            [
                'id'    => 40,
                'title' => 'reservation_delete',
            ],
            [
                'id'    => 41,
                'title' => 'reservation_access',
            ],
            [
                'id'    => 42,
                'title' => 'newsletter_create',
            ],
            [
                'id'    => 43,
                'title' => 'newsletter_edit',
            ],
            [
                'id'    => 44,
                'title' => 'newsletter_show',
            ],
            [
                'id'    => 45,
                'title' => 'newsletter_delete',
            ],
            [
                'id'    => 46,
                'title' => 'newsletter_access',
            ],
            [
                'id'    => 47,
                'title' => 'minute_data_create',
            ],
            [
                'id'    => 48,
                'title' => 'minute_data_edit',
            ],
            [
                'id'    => 49,
                'title' => 'minute_data_show',
            ],
            [
                'id'    => 50,
                'title' => 'minute_data_delete',
            ],
            [
                'id'    => 51,
                'title' => 'minute_data_access',
            ],
            [
                'id'    => 52,
                'title' => 'site_specific_access',
            ],
            [
                'id'    => 53,
                'title' => 'amenity_access',
            ],
            [
                'id'    => 54,
                'title' => 'todo_create',
            ],
            [
                'id'    => 55,
                'title' => 'todo_edit',
            ],
            [
                'id'    => 56,
                'title' => 'todo_show',
            ],
            [
                'id'    => 57,
                'title' => 'todo_delete',
            ],
            [
                'id'    => 58,
                'title' => 'todo_access',
            ],
            [
                'id'    => 59,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
