<?php

use App\Session;
use Illuminate\Database\Seeder;

class SessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $session = new Session();
        $session->year = '2023/2024';
        $session->start_date = '2023-02-02';
        $session->end_date = '2023-10-10';
        // $session->status = 1;
        $session->save();
    }
}
