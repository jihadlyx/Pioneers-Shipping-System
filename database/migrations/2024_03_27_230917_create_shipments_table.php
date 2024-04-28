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
        Schema::create('shipments', function (Blueprint $table) {
            $table->integer('id_ship')->unsigned()->primary();
            $table->string('name_ship', 50);
            $table->integer('id_customer')->unsigned();
            $table->integer('id_status')->unsigned();
            $table->integer('id_city')->unsigned();
            $table->double("ship_value");
            $table->bigInteger('phone_number');
            $table->bigInteger('phone_number2')->nullable();
            $table->string('address', 30);
            $table->string('notes', 50)->nullable();
            $table->string('recipient_name', 40);
            $table->timestamps();

            // Adding foreign key constraint
            $table->foreign('id_customer')->references('id_customer')->on('customers')->onDelete('cascade');
            $table->foreign('id_status')->references('id_status')->on('type_ship_statuses')->onDelete('cascade');
            $table->foreign('id_city')->references('id_city')->on('sub_cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
};
