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
        Schema::create('insurers', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable()->default(null);
            $table->string('name')->unique();
            $table->timestamps();
        });

        DB::table('insurers')->insert([
            ['name' => 'ICICI LOMBARD GENERAL INSURANCE COMPANY LIMITED'],
            ['name' => 'TATA AIG GENERAL INSURANCE '],
            ['name' => 'THE ORIENTAL INSURANCE COMPANY'],
            ['name' => 'CARE HEALTH INSURANCE LIMITED'],
            ['name' => 'IFFCO-TOKIO GENERAL INSURANCE COMPANY LTD'],
            ['name' => 'MAGMA HDI GENERAL INSURANCE CO LTD'],
            ['name' => 'LIBERTY GENERAL INSURANCE COMPANY'],
            ['name' => 'SBI GENERNAL INSURANCE COMPANY LIMITED'],
            ['name' => 'NEW INDIA ASSURANCE COMPANY CO LTD'],
            ['name' => 'UNITED INDIA INSURANCE '],
            ['name' => 'NATIONAL INSURANCE COMPANY LTD'],
            ['name' => 'CHOLAMANDALAM MS GENERAL INSURANCE COMPANY'],
            ['name' => 'STAR HEALTH AND ALLIED INSURANCE'],
            ['name' => 'KOTAK MAHINDRA GENERAL INSURANCE'],
            ['name' => 'HDFC ERGO GENERAL INSURANCE '],
            ['name' => 'REIANCE GENERAL INSURANCE'],
            ['name' => 'GO DIGIT GENERAL INSURANCE LIMITED'],
            
        ]);

        $insurers = DB::table('insurers')->get();

        foreach ($insurers as $insurer) {
            $uuid = Uuid::uuid4()->toString();
            DB::table('insurers')->where('id', $insurer->id)->update(['uuid' => $uuid]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insurers');
    }
};
