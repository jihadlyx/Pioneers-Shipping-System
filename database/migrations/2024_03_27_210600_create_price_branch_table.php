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
        Schema::create('prices', function (Blueprint $table) {
            $table->integer("id")->unsigned()->primary();
            $table->integer('from_branch')->unsigned();
            $table->integer('to_branch')->unsigned();
            $table->double("price");
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('from_branch')->references('branch_id')->on('branches')->onDelete('cascade');
            $table->foreign('to_branch')->references('branch_id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices');
    }
};
