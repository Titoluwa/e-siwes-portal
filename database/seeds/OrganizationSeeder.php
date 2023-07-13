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
        DB::table('organization')->insert([
            'name' => 'DEFAULT',
            'status' => 0,
            '' => 'Computer Science with Economics',
        ]);
    }
}
