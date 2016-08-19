<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignsKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function ($table) {
        $table->foreign('region_id')->references('id')->on('regions')
          ->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('city_id')->references('id')->on('cities')
          ->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('state_id')->references('id')->on('states')
          ->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('store_id')->references('id')->on('stores')
          ->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('rol_id')->references('id')->on('rols')
          ->onDelete('cascade')->onUpdate('cascade');
      });

      Schema::table('cities', function ($table) {
        $table->foreign('region_id')->references('id')->on('regions')
          ->onDelete('cascade')->onUpdate('cascade');
      });

      Schema::table('stores', function ($table) {
        $table->foreign('region_id')->references('id')->on('regions')
          ->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('city_id')->references('id')->on('cities')
          ->onDelete('cascade')->onUpdate('cascade');
      });

      Schema::table('comments', function ($table) {
        $table->foreign('user_id')->references('id')->on('users')
          ->onDelete('cascade')->onUpdate('cascade');
      });

      Schema::table('issues', function ($table) {
        $table->foreign('user_id')->references('id')->on('users')
          ->onDelete('cascade')->onUpdate('cascade');
      });

      Schema::table('sales', function ($table) {
        $table->foreign('user_id')->references('id')->on('users')
          ->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('seller_id')->references('id')->on('users')
          ->onDelete('cascade')->onUpdate('cascade');
      });

      Schema::table('orders', function ($table) {
        $table->foreign('user_id')->references('id')->on('users')
          ->onDelete('cascade')->onUpdate('cascade');
      });

      Schema::table('products', function ($table) {
        $table->foreign('category_id')->references('id')->on('categories')
          ->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('region_id')->references('id')->on('regions')
          ->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('city_id')->references('id')->on('cities')
          ->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('store_id')->references('id')->on('stores')
          ->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('provider_id')->references('id')->on('providers')
          ->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('state_id')->references('id')->on('states')
          ->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('maintenance_id')->references('id')->on('maintenances')
          ->onDelete('cascade')->onUpdate('cascade');
      });

      Schema::table('maintenances', function ($table) {
        $table->foreign('seller_id')->references('id')->on('users')
          ->onDelete('cascade')->onUpdate('cascade');
      });

      Schema::table('maintenance_product', function ($table) {
          $table->foreign('maintenance_id')->references('id')->on('maintenances')
            ->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('product_id')->references('id')->on('products')
            ->onDelete('cascade')->onUpdate('cascade');
      });

      Schema::table('sale_product', function ($table) {
          $table->foreign('product_id')->references('id')->on('products')
            ->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('sale_id')->references('id')->on('sales')
            ->onDelete('cascade')->onUpdate('cascade');
      });

      Schema::table('order_product', function ($table) {
          $table->foreign('product_id')->references('id')->on('products')
            ->onDelete('cascade')->onUpdate('cascade');
          $table->foreign('order_id')->references('id')->on('orders')
            ->onDelete('cascade')->onUpdate('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('foreigns_keys');
    }
}