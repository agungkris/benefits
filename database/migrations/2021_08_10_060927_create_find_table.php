<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFindTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('find', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sender');
            $table->integer("isFriend");
            $table->unsignedBigInteger("id_reciever");
            $table->integer("match");

            $table->foreign('id_sender')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('id_reciever')->on('users')->references('id')->onDelete('cascade');
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
        Schema::table('find', function (Blueprint $table) {
            $table->dropForeign(['id_sender']);
            $table->dropForeign(['id_reciever']);
        });
        Schema::dropIfExists('find');
    }
}
