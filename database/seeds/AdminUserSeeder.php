<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->first_name = 'Admin';
        $admin->last_name = 'ITCU';
        $admin->email = 'itcu@oauife.edu.ng';
        $admin->contact_no = '08115776482';
        $admin->profile_pic = 'images/oau-view-2.webp';
        $admin->password = bcrypt('adminitcu');
        $admin->save();
    }
}
