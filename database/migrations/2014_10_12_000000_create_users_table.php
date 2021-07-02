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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('phone')->unique();
            $table->string('gender');
            $table->string('city');
            $table->string('photo');
            $table->string('about');
            $table->integer('age');
            $table->string('zodiac');
            $table->boolean('drink');
            $table->boolean('gym');
            $table->boolean('smoke');
            $table->string('status');
            $table->string('latitude');
            $table->string('longitude');
            $table->integer('isFriend');
            $table->string('interest');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('notif')->default('aktif');
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
