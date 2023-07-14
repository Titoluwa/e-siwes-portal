<?php

use Illuminate\Database\Seeder;
class DatabaseSeeder extends Seeder
{
    // php artisan make:seeder UserSeeder
    // php artisan db:seed
    // php artisan db:seed --class=UserSeeder
    
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminUserSeeder::class,
            ItfAgentSeeder::class,
            DepartmentSeeder::class,
            OrganizationSeeder::class,
            SessionSeeder::class,
            StaffSeeder::class,
        ]);
    }
}
