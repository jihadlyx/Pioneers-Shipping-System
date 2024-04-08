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
        Schema::create('matirial_roles', function (Blueprint $table) {
            $table->integer("id")->unsigned()->primary();
            $table->integer('id_role')->unsigned();
            $table->integer('id_page')->unsigned();
            $table->boolean('create');
            $table->boolean('update');
            $table->boolean('delete');
            $table->boolean('show');
            $table->timestamps();

            $table->foreign('id_role')->references('id_role')->on('roles')->onDelete('cascade');
            $table->foreign('id_page')->references('id_page')->on('pages')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matirial_roles');
    }
};