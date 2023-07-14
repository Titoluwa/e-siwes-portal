<?php

use App\User;
use App\Staff;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->first_name = 'Toluwani';
        $user->last_name = 'Oluwaranti';
        $user->email = 'titoluwaranti@oauife.edu.ng';
        $user->contact_no = '08115776482';
        $user->role_id = 2;
        $user->password = bcrypt('toluwanistaff');
        $user->save();

        $staff = new Staff();
        // $staff->staff_id - "OAUstaff";
        $staff->user_id = $user->id;
        $staff->faculty = 'Technology';
        $staff->department = 'Computer Science and Engineering';
        $staff->save();
    }
}
