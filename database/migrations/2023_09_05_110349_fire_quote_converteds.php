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
        Schema::create('fire_quote_converteds', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable()->default(null);
            $table->morphs('firepremiable');
            $table->bigInteger('net_od_premium');
            $table->bigInteger('net_terrorism_premium');
            $table->integer('gst');
            $table->bigInteger('gross_premium');
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
        Schema::dropIfExists('fire_quote_converteds');
    }
};
