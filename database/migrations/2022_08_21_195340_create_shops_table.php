<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('area_id')->constrained();
            $table->char('postal_code', 7);
            $table->string('address');
            $table->string('opening_hour')->nullable();
            $table->string('holiday')->nullable();
            $table->string('tel_number')->nullable();
            $table->string('email')->nullable();
            $table->string('shop_img')->nullable();
            $table->string('shop_img_rename')->nullable();
            $table->string('shop_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->timestamps();
        });
        
    }
    
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
