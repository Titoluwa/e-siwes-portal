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
            'course_study' => 'Computer Engineering',
        ]);
        DB::table('departments')->insert([
            'faculty' => 'Technology',
            'department' => 'Computer Science and Engineering',
            'course_study' => 'Computer Science with Mathematics',
        ]);
        DB::table('departments')->insert([
            'faculty' => 'Technology',
            'department' => 'Computer Science and Engineering',
            'course_study' => 'Computer Science with Economics',
        ]);
        DB::table('departments')->insert([
            'faculty' => 'Technology',
            'department' => 'Electrical and Electronic Engineering',
            'course_study' => 'Electrical and Electronic Engineering',
        ]);
    }
}
