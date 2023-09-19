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
        Schema::create('converted_insurers', function (Blueprint $table) {
                $table->id();
                $table->uuid('uuid')->unique()->nullable()->default(null);
                $table->morphs('convertable');
                $table->unsignedBigInteger('insurer_id');
                $table->bigInteger('share_in_percentage');
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
        Schema::dropIfExists('converted_insurers');
    }
};
