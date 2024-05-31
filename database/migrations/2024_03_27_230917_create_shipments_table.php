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
            $table->integer('ship_id')->unsigned()->primary();
            $table->string('ship_name', 50);
            $table->integer('customer_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->integer('region_id')->unsigned();
            $table->double("ship_value");
            $table->bigInteger('phone_number');
            $table->bigInteger('phone_number2')->nullable();
            $table->string('address', 30);
            $table->string('notes', 50)->nullable();
            $table->string('recipient_name', 40);
            $table->timestamps();
            $table->softDeletes();
            // Adding foreign key constraint
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->foreign('status_id')->references('status_id')->on('type_ship_statuses')->onDelete('cascade');
            $table->foreign('region_id')->references('region_id')->on('regions')->onDelete('cascade');
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
