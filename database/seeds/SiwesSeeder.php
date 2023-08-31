<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiwesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('siwes_type')->insert([
            'name' => 'SWEP 200',
            'code_name' => 'swep-200'
        ]);
        DB::table('siwes_type')->insert([
            'name' => 'SIWES 300',
            'code_name' => 'siwes-300'
        ]);
        DB::table('siwes_type')->insert([
            'name' => 'SIWES 400',
            'code_name' => 'siwes-400'
        ]);
    }
}
