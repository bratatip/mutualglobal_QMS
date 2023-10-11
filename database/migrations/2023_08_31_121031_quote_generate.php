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

            $table->boolean('claim_status')->default(false);
            $table->string('year_of_claim')->nullable()->default(null);
            $table->string('cause_of_loss')->nullable()->default(null);
            $table->decimal('claim_amount', 15, 2)->nullable()->default(0);


            $table->decimal('buildings_and_other_structural_work', 15, 2)->nullable()->default(0);
            $table->decimal('plants_and_machines', 15, 2)->nullable()->default(0);
            $table->decimal('mbd', 15, 2)->nullable()->default(0);
            $table->decimal('electrical_fittings', 15, 2)->nullable()->default(0);
            $table->decimal('eei', 15, 2)->nullable()->default(0);
            $table->decimal('computer_and_all_movables', 15, 2)->nullable()->default(0);
            $table->decimal('furniture_and_fittings', 15, 2)->nullable()->default(0);
            $table->decimal('stock_in_process', 15, 2)->nullable()->default(0);
            $table->decimal('finished_good', 15, 2)->nullable()->default(0);
            $table->decimal('fassade_glasses', 15, 2)->nullable()->default(0);
            $table->decimal('pgi', 15, 2)->nullable()->default(0);
            $table->decimal('loss_of_rent', 15, 2)->nullable()->default(0);
            $table->integer('no_of_months_loss')->nullable()->default(0);
            $table->decimal('business_interuption', 15, 2)->nullable()->default(0);
            $table->integer('bi_no_of_months')->nullable()->default(0);
            $table->boolean('basement_risk')->default(false);
            
            $table->decimal('total_sum_insured', 15, 2)->default(0);
            $table->boolean('terrorism')->default(false);
            $table->boolean('burglary')->default(false);

            $table->decimal('cash_in_counter', 15, 2)->nullable()->default(0);
            $table->decimal('cash_in_transit', 15, 2)->nullable()->default(0);
            $table->decimal('cash_in_safe', 15, 2)->nullable()->default(0);
            $table->decimal('psl', 15, 2)->nullable()->default(0);
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
