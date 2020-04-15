<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\softDeletes;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_name');
            $table->string('product_link',1000);
            $table->string('link_image',1000);
            $table->string('average_rating')->nullable();
            $table->integer('provider_id')->unsigned();
            $table->integer('specification_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();//delete_at

            $table->unique(['product_name', 'provider_id']);
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->foreign('specification_id')->references('id')->on('specifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
