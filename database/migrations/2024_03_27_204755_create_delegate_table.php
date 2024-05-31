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
        Schema::create('delivery_men', function (Blueprint $table) {
            $table->integer('delivery_id')->unsigned()->primary();
            $table->string('delivery_name', 50);
            $table->bigInteger('phone_number');
            $table->bigInteger('phone_number2')->nullable();
            $table->string('address', 30);
            $table->integer('number_id');
            $table->integer('branch_id')->unsigned();
            $table->integer('role_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('branch_id')->references('branch_id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_men');
    }
};
