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
            $table->string('name')->default("");
            $table->string('email')->default("")->unique();
            $table->bigInteger('phone')->default(0)->nullable()->unique();
            $table->string('gender')->default("")->nullable();
            $table->string('city')->default("")->nullable();
            $table->string('photo1')->default("")->nullable();
            $table->string('photo2')->default("")->nullable();
            $table->string('photo3')->default("")->nullable();
            $table->string('photo4')->default("")->nullable();
            $table->string('about')->default("")->nullable();
            $table->integer('age')->default(0)->nullable();
            $table->string('zodiac')->default("")->nullable();
            $table->string('drink')->default("")->nullable();
            $table->string('gym')->default("")->nullable();
            $table->string('smoke')->default("")->nullable();
            $table->string('status')->default("")->nullable();
            $table->string('latitude')->default("")->nullable();
            $table->string('longitude')->default("")->nullable();
            $table->integer('isFriend')->default(0)->nullable();
            $table->string('interest')->default("")->nullable();
            $table->string('religion')->default("")->nullable();
            $table->string('education')->default("")->nullable();
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
