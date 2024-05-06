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
        Schema::create('status_shipments', function (Blueprint $table) {
            $table->integer("id")->unsigned()->primary();
            $table->integer('id_ship')->unsigned();
            $table->integer('id_status')->unsigned();
            $table->integer('id_delegate')->unsigned();
            $table->foreignId('id_user');
            $table->date('date_update');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_status')->references('id_status')->on('type_ship_statuses')->onDelete('cascade');
            $table->foreign('id_ship')->references('id_ship')->on('shipments')->onDelete('cascade');
            $table->foreign('id_delegate')->references('id_delegate')->on('delegates')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_shipments');
    }
};
