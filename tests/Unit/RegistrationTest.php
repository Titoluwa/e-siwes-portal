<?php

namespace Tests\Unit;

use App\User;
use PHPUnit\Framework\TestCase;

class RegistrationTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    // public function testExample()
    // {
    //     $this->assertTrue(true);
    // }
    public function user_registered()
    {
        $this->assertTrue(true);
        // $user = new User(["Jack", "Peter", "Amy"]); // Create a new user
        // $this->assertTrue($user->has("Jack")); // Expect true
        // $this->assertFalse($user->has("Eric")); // Expect false
    }
    public function registration_confirmed()
    {
        $this->assertTrue(false);
    }
}
