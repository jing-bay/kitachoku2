<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopTagTable extends Migration
{
    public function up()
    {
        Schema::create('shop_tag', function (Blueprint $table) {
            $table->id();
            $table->integer('tag_id')->constrained()->cascadeOnDelete();
            $table->integer('shop_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shop_tag');
    }
}
