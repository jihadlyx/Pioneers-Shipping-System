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
        Schema::create('shipment_on_service', function (Blueprint $table) {
            $table->integer("id")->unsigned()->primary();
            $table->integer('ship_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->integer('delivery_id')->unsigned();
            $table->integer('id_user')->unsigned();;
            $table->date('date_update');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_user')->references('pid')->on('users')->onDelete('cascade');
            $table->foreign('status_id')->references('status_id')->on('type_ship_statuses')->onDelete('cascade');
            $table->foreign('ship_id')->references('ship_id')->on('shipments')->onDelete('cascade');
            $table->foreign('delivery_id')->references('delivery_id')->on('delivery_men')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_on_service');
    }
};
