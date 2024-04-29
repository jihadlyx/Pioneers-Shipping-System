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
        Schema::create('branches', function (Blueprint $table) {
            $table->integer('id_branch')->unsigned()->primary();
            $table->string('title', 20);
            $table->string('address', 30);
            $table->bigInteger('phone_number');
//            $table->bigInteger('phone_number')->digits_between(10, 14);
            $table->bigInteger('phone_number2')->nullable();
            $table->boolean('state');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
};
