<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
//            PermissionsTableSeeder::class,
            PermissionsTableSeederForSchool::class,
//            RolesTableSeeder::class,
//            PermissionRoleTableSeeder::class,
//            UsersTableSeeder::class,
//            RoleUserTableSeeder::class,
//            SettingsTableSeeder::class,
//            SpeakersTableSeeder::class,
//            SchedulesTableSeeder::class,
//            VenuesTableSeeder::class,
//            GalleriesTableSeeder::class,
//            SponsorsTableSeeder::class,
//            FaqsTableSeeder::class,
//            AmenitiesTableSeeder::class,
//            PricesTableSeeder::class,
//            AmenityPriceTableSeeder::class,
        ]);
    }
}
