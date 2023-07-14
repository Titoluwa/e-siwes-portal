<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->insert([
            'name' => 'DEFAULT',
            'user_id' => 1,
            'full_address' => 'none',
            'postal_address' => 'example@mail.com',
            'status' => 0,
        ]);
    }
}
