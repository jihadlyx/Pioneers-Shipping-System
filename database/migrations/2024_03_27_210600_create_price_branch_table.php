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
        Schema::create('price_branch', function (Blueprint $table) {
            $table->integer("id")->unsigned()->primary();
            $table->integer('id_from_branch')->unsigned();
            $table->integer('id_to_branch')->unsigned();
            $table->double("price");
            $table->timestamps();

            $table->foreign('id_from_branch')->references('id_branch')->on('branches')->onDelete('cascade');
            $table->foreign('id_to_branch')->references('id_branch')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('price_branch');
    }
};
