<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavCalendarsTable extends Migration
{
    public function up()
    {
        Schema::create('fav_calendars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();;
            $table->foreignId('calendar_id')->constrained()->cascadeOnDelete();;
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('fav_calendars');
    }
}
