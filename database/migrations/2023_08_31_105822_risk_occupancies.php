<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('risk_occupancies', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable()->default(null);
            $table->string('iib_code')->nullable()->default(null);
            $table->text('risk_occupancy');
            $table->string('risk_code')->nullable()->default(null);
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
        Schema::dropIfExists('risk_occupancies');

    }
};
