<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ControllerStatesTest extends TestCase
{
    use DatabaseTransactions;
    
    public function testExample()
    {
        $this->assertTrue(true);
    }
}