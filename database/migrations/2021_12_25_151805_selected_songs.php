<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SelectedSongs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('song', function (Blueprint $table){
            $table->boolean('selected')->default(0);
        });
        Schema::create('selected_songs', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('song_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('place');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
