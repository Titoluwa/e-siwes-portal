<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'faculty' => 'Technology',
            'department' => 'Computer Science and Engineering',
            'course_study' => 'Computer Science with Economics',
        ]);
    }
}
