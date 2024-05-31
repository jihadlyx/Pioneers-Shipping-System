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
        Schema::create('permissions', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary();
            $table->integer('role_id')->unsigned();
            $table->integer('page_id')->unsigned();
            $table->boolean('create');
            $table->boolean('update');
            $table->boolean('delete');
            $table->boolean('show');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('role_id')->references('role_id')->on('roles')->onDelete('cascade');
            $table->foreign('page_id')->references('page_id')->on('pages')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
};
