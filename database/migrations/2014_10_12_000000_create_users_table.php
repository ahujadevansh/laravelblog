<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('email', 180)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('gender', array('Male', 'Female', 'Other'));
            $table->date('date_of_birth')->nullable();
            $table->longText('address')->nullable();
            $table->string('phone', 15)->nullable();
            $table->string('profile_image')->default('nopic.jpg');
            $table->string('password')->nullable();
            $table->boolean('status')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
