<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\softDeletes;
use Illuminate\Database\Migrations\Migration;

class CreateSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('display')->nullable();
            $table->string('operating_system')->nullable();
            $table->string('front_camera')->nullable();
            $table->string('rear_camera')->nullable();
            $table->string('battery')->nullable();
            $table->string('ram')->nullable();
            $table->string('cpu')->nullable();
            $table->string('brand')->nullable();
            $table->timestamps();
            $table->softDeletes();//delete_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specifications');
    }
}
