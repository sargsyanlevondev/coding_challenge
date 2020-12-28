<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offering', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->integer('quantity');
            $table->integer('price');
            $table->timestamps();
        });

        \Illuminate\Support\Facades\Artisan::call('db:seed', [
            '--class' => 'Offering',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offering');
    }
}
