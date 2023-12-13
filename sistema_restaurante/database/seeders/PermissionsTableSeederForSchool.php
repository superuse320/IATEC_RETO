<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeederForSchool extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'         => '67',
                'title'      => 'school_create',
                'created_at' => '2019-09-24 19:16:02',
                'updated_at' => '2019-09-24 19:16:02',
            ],
            [
                'id'         => '68',
                'title'      => 'school_edit',
                'created_at' => '2019-09-24 19:16:02',
                'updated_at' => '2019-09-24 19:16:02',
            ],
            [
                'id'         => '69',
                'title'      => 'school_show',
                'created_at' => '2019-09-24 19:16:02',
                'updated_at' => '2019-09-24 19:16:02',
            ],
            [
                'id'         => '70',
                'title'      => 'school_delete',
                'created_at' => '2019-09-24 19:16:02',
                'updated_at' => '2019-09-24 19:16:02',
            ],
            [
                'id'         => '71',
                'title'      => 'school_access',
                'created_at' => '2019-09-24 19:16:02',
                'updated_at' => '2019-09-24 19:16:02',
            ],
        ];

        Permission::insert($permissions);
    }
}
