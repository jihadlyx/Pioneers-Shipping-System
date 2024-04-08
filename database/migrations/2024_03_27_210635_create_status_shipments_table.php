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
            $table->integer('id_ship');
            $table->integer('id_state');
            $table->integer('id_delegate');
            $table->integer('id_user');
            $table->date('date_update');
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
        Schema::dropIfExists('status_shipments');
    }
};