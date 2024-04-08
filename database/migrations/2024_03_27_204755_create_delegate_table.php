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
        Schema::create('delegate', function (Blueprint $table) {
            $table->integer('id_delegate')->unsigned()->primary();
            $table->string('name_delegate', 50);
            $table->bigInteger('phone_number');
            $table->bigInteger('phone_number2')->nullable();
            $table->string('address', 30);
            $table->integer('id_number');
            $table->integer('id_branch')->unsigned();
            $table->integer('id_role');
            $table->timestamps(); // Adds created_at and updated_at columns

            // Adding foreign key constraint
            $table->foreign('id_branch')->references('id_branch')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delegate');
    }
};