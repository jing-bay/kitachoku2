<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{
    public function up()
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('shop_id')->constrained();
            $table->string('name');
            $table->unsignedTinyInteger('start_date');
            $table->unsignedTinyInteger('end_date');
            $table->string('comment');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calendars');
    }
}
