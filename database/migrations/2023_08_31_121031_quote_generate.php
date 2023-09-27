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
        Schema::create('quote_generate', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable()->default(null);
            $table->string('quote_no');
            $table->integer('customer_id');
            $table->integer('product_id');
            $table->integer('rm_id');
            $table->string('risk_location');
            $table->integer('risk_occupancy_id');

            $table->string('policy_type');

            $table->boolean('claim_status');
            $table->string('year_of_claim')->nullable()->default(null);
            $table->string('cause_of_loss')->nullable()->default(null);
            $table->bigInteger('claim_amount')->nullable()->default(0);


            $table->bigInteger('buildings_and_other_structural_work')->nullable()->default(0);
            $table->bigInteger('plants_and_machines')->nullable()->default(0);
            $table->bigInteger('mbd')->nullable()->default(0);
            $table->bigInteger('electrical_fittings')->nullable()->default(0);
            $table->bigInteger('eei')->nullable()->default(0);
            $table->bigInteger('computer_and_all_movables')->nullable()->default(0);
            $table->bigInteger('furniture_and_fittings')->nullable()->default(0);
            $table->bigInteger('stock_in_process')->nullable()->default(0);
            $table->bigInteger('finished_good')->nullable()->default(0);
            $table->bigInteger('fassade_glasses')->nullable()->default(0);
            $table->bigInteger('pgi')->nullable()->default(0);
            $table->bigInteger('loss_of_rent')->nullable()->default(0);
            $table->integer('no_of_months_loss')->nullable()->default(0);
            $table->bigInteger('business_interuption')->nullable()->default(0);
            $table->integer('bi_no_of_months')->nullable()->default(0);
            $table->boolean('basement_risk');
            
            $table->bigInteger('total_sum_insured');
            $table->boolean('terrorism');

            $table->bigInteger('cash_in_counter')->nullable()->default(0);
            $table->bigInteger('cash_in_transit')->nullable()->default(0);
            $table->bigInteger('cash_in_safe')->nullable()->default(0);
            $table->bigInteger('psl')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quote_generate');
    }
};
