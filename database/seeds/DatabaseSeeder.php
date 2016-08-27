<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

  public function run()
  {
    $user = factory(App\User::class)->create([
      'username' => 'Administrator',
      'email' => 'admin@admin.com',
      'password' => bcrypt("123456"),
    ]);

    factory(App\Category::class)->create(['name' => 'Notebook']);
    factory(App\State::class)->create(['name' => 'Active']);
    factory(App\Region::class)->create(['name' => 'Detroit']);
    factory(App\City::class)->create(['name' => 'Kyoto']);
    factory(App\Log::class)->create(['name' => 'Login']);
    factory(App\Provider::class)->create(['name' => 'Apple']);
    factory(App\Comment::class)->create(['name' => 'Awesome']);
    factory(App\Issue::class)->create(['name' => 'Error']);
    factory(App\Store::class)->create(['name' => 'Shibuya']);
    factory(App\Product::class)->create(['name' => 'MacBook']);
    factory(App\Maintenance::class)->create(['name' => 'OSX']);
    factory(App\Rol::class)->create(['name' => 'User']);
    factory(App\Rol::class)->create(['name' => 'Storer']);
    factory(App\Rol::class)->create(['name' => 'Admin']);


    $products = factory(App\Product::class, 10)->create()
      ->each(function($product) {
        $category = App\Category::find(1);
        $provider = App\Provider::find(1);
        $store = App\Store::find(1);
        $maintenance = App\Maintenance::find(1);
        $state = App\State::find(1);
        $category->product()->save($product);
        $provider->product()->save($product);
        $store->product()->save($product);
        $maintenance->product()->save($product);
        $state->product()->save($product);
    });

    $cities = factory(App\City::class, 10)->create()
      ->each(function($city) {
        $city = App\City::find(1);
        $region->city()->save($city);
    });

    $stores = factory(App\Store::class, 10)->create()
      ->each(function($store) {
        $store = App\Store::find(1);
        $city->store()->save($store);
    });

    $users = factory(App\User::class, 10)->create()
      ->each(function($user) {
        $store = App\Store::find(1);
        $state = App\State::find(1);
        $rol = App\Rol::find(1);
        $store->user()->save($user);
        $state->user()->save($user);
        $rol->user()->save($user);
    });

    $logs = factory(App\Log::class, 10)->create()
      ->each(function($log) {
        $user = App\User::find(1);
        $user->log()->save($log);
    });

    $maintenances = factory(App\Maintenance::class, 10)->create()
      ->each(function($maintenance) {
        $user = App\User::find(1);
        $state = App\State::find(1);
        $state->maintenance()->save($maintenance);
        $user->maintenance()->save($maintenance);
    });

    $comments = factory(App\Comment::class, 10)->create()
      ->each(function($comment) {
        $user = App\User::find(1);
        $issue = App\Issue::find(1);
        $user->comment()->save($comment);
        $issue->comment()->save($comment);
    });

    $categories = factory(App\Category::class, 10)->create()
      ->each(function($category) {
        $product = App\Product::find(1);
        $product->category()->save($category);
    });

    $issues = factory(App\Issue::class, 10)->create()
      ->each(function($issue) {
        $user = App\User::find(1);
        $user->issue()->save($issue);
    });

    $orders = factory(App\Order::class, 10)->create()
      ->each(function($order) {
        $user = App\User::find(1);
        $state = App\State::find(1);
        $products->order()->save($order);
        $user->order()->save($order);
        $state->order()->save($order);
    });

    $sales = factory(App\Sale::class, 10)->create()
      ->each(function($sale) {
        $user = App\User::find(1);
        $order = App\Order::find(1);
        $state = App\State::find(1);
        $order->sale()->save($sale);
        $user->sale()->save($sale);
        $state->sale()->save($sale);
    });

  }
}
