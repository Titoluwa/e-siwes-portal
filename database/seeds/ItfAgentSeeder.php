<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItfAgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $agent = new User();
        $agent->first_name = 'ITF';
        $agent->last_name = 'Agent';
        $agent->email = 'agent@itf.com';
        $agent->contact_no = '08115776483';
        $agent->role_id = 4;
        $agent->password = bcrypt('agentitf');
        $agent->save();
        
        DB::table('itfs')->insert([
            'user_id' => $agent->id,
            'state_location' => 'Lagos',
            'office_address' => '144 Oba Akran Ave, Ikeja, Lagos',
            
        ]);
    }
}
