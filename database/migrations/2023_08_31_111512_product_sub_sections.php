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
        Schema::create('product_sub_sections', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable()->default(null);
            $table->string('name');
            $table->timestamps();
        });

        DB::table('product_sub_sections')->insert([
            ['name' => 'Excess'],
            ['name' => 'Clauses'],
            ['name' => 'Conditions/Warranties'],
        ]);

        $product_sub_sections = DB::table('product_sub_sections')->get();

        foreach ($product_sub_sections as $product) {
            $uuid = Uuid::uuid4()->toString();
            DB::table('product_sub_sections')->where('id', $product->id)->update(['uuid' => $uuid]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_sub_sections');
    }
};
