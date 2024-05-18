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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
//            $table->string('name');
            $table->string('email')->unique();
            $table->integer("id_type_users");
            $table->integer("pid");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('id_emp')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_emp')->references('id_emp')->on('employees')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
