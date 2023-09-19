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
        Schema::create('primary_email_cc_email', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable()->default(null);
            $table->unsignedBigInteger('primary_email_id')->index();
            $table->foreign('primary_email_id')->references('id')->on('primary_emails');
            $table->unsignedBigInteger('cc_email_id')->index();
            $table->foreign('cc_email_id')->references('id')->on('c_c_emails');
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
        Schema::dropIfExists('primary_email_cc_email');

    }
};
