<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /// Keeping it simple, I am using one table for all specifications or dimensions.
        /// This way has its own pros/cons but it should be a team decision on architecture.
        Schema::create('specifications', function (Blueprint $table) {
            $table->increments('id');
            $table
                ->integer('product_id');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->string('species');
            $table->string('grading_system');
            $table->string('drying_method');
            $table->string('treatment')->nullable();
            $table->integer('thickness');
            $table->integer('width');
            $table->integer('length');
            $table->timestamps();
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
};
