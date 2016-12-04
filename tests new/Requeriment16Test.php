<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Requeriment16Test extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testProductStore()
    {
      $this->visit('/products');
      $this->visit('/products/create');
      $this->type('TestProduct', 'name');
      $this->type('TESTSERIAL', 'serial');
      $this->type('2016', 'year');
      $this->type('20000000', 'price');
      $this->type('12', 'warranty');
      $this->press('Agregar');
      $this->seePageIs('/products');
      $this->see('Create Product Complete!');
    }
}