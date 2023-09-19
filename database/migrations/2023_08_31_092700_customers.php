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
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique()->nullable()->default(null);
            // $table->unsignedBigInteger('user_id')->index()->references('id')->on('users')->onDelete('cascade');
            $table->string('customer_id')->nullable()->default(null);
            $table->string('name')->nullable()->default(null);
            $table->text('address')->nullable()->default(null);
            $table->string('zip_code')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('contact_person_phone')->nullable()->default(null);
            $table->string('contact_person_name')->nullable()->default(null);
            $table->string('pan')->unique()->nullable()->default(null);
            $table->string('gst')->unique()->nullable()->default(null);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
