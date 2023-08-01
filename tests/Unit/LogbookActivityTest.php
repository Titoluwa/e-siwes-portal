<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;


class LogbookActivityTest extends TestCase
{
    /**
     * @var array
     */
    protected $user = [];

    /**
     * Constructor. Fill the room with the given people.
     *
     * @param array $user
     */
    public function __construct($user = [])
    {
        $this->user = $user;
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
    public function add_daily($logbook)
    {
        array_push($this->user, $logbook);
        $this->assertTrue(true);
        return $this->user;
    }
    public function add_weekly($logbook)
    {
        $this->assertTrue(true);

        array_push($this->user, $logbook);
        return $this->user;
    }
    public function add_monthly($logbook)
    {
        $this->assertTrue(true);

        array_push($this->user, $logbook);
        return $this->user;
    }
}


