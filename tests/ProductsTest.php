<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductsTest extends TestCase
{
  /**
  * A basic test example.
  *
  * @return void
  */
  public function testProductsIndex()
  {
    $user = App\User::find(1);
    $this->be($user);

    $response = $this->action('GET', 'ProductsController@index');

    $this->assertEquals(200, $response->status());
  }

  public function testProductsUpdate()
  {
    $product = App\Product::find(1);
    $product->name = "iMac";

    $response = $this->action('PUT', 'ProductsController@update', $product->id);
    $this->seeInDatabase('products', ['name' => $product->name]);
    $this->assertEquals(200, $response->status());
  }

  public function testProductsShow()
  {
    $response = $this->action('GET', 'ProductsController@show', ['product' => 1]);
    $this->assertEquals(200, $response->status());
  }

  public function testProductsEdit()
  {
    $admin = App\User::find(3);
    $this->be($admin);

    $response = $this->action('GET', 'ProductsController@edit', ['product' => 1]);

    $this->assertEquals(200, $response->status());
  }

  public function testProductsDestroy()
  {
    $response = $this->action('GET', 'ProductsController@destroy', ['product' => 1]);

    $this->assertEquals(200, $response->status());
  }
}