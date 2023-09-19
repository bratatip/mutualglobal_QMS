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
        Schema::create('primary_emails', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable()->default(null);
            $table->string('email');
            $table->unsignedBigInteger('insurer_id')->index();
            $table->foreign('insurer_id')->references('id')->on('insurers');
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
        Schema::dropIfExists('primary_emails');
    }
};
