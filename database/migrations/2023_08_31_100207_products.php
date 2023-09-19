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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable()->default(null);
            $table->string('name')->unique();
            $table->timestamps();
        });

        DB::table('products')->insert([
            ['name' => 'FIRE'],
            ['name' => 'CAR'],
            ['name' => 'EAR'],
            ['name' => 'CPM'],
            ['name' => 'Marine'],
            ['name' => 'Liability'],
            ['name' => 'WC'],
            ['name' => 'Motor'],
            ['name' => 'GHI'],
        ]);

        $products = DB::table('products')->get();

        foreach ($products as $product) {
            $uuid = Uuid::uuid4()->toString();
            DB::table('products')->where('id', $product->id)->update(['uuid' => $uuid]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
