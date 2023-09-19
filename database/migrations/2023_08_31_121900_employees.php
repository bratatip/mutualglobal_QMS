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

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->nullable()->default(null);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->timestamps();
        });
 
        DB::table('employees')->insert([
            [
                'name' => 'Bishnu Hotta',
                'phone' => '9980111799',
                'email' => 'bishnu.hotta@mutualglobal.com',
            ],
            [
                'name' => 'Bratati Pattajoshi',
                'phone' => '9663611125',
                'email' => 'bratati@mutualglobal.com',
            ],
            [
                'name' => 'Bidyut Nayak',
                'phone' => '7204532077',
                'email' => 'bidyut@mutualglobal.com',
            ],
            [
                'name' => 'Sushil Kumar Behera',
                'phone' => '9019463513',
                'email' => 'sushil@mutualglobal.com',
            ],
            [
                'name' => 'Ismail Bagwan',
                'phone' => '7406444191',
                'email' => 'ismail@mutualglobal.com',
            ],
            [
                'name' => 'Monika Jha',
                'phone' => '7406444181',
                'email' => 'support@mutualglobal.com',
            ],
            [
                'name' => 'Teja Thota',
                'phone' => '8310311785',
                'email' => 'teja@mutualglobal.com',
            ],
            [
                'name' => 'Sushmita M',
                'phone' => '8660365739',
                'email' => 'accounts@mutualglobal.com',
            ],
            [
                'name' => 'Sushmita K R',
                'phone' => '9986259122',
                'email' => 'sandhiya@mutualglobal.com',
            ],
            [
                'name' => 'Xavier R',
                'phone' => '9986206122',
                'email' => 'xavier@mutualglobal.com',
            ],
            [
                'name' => 'Namita Nair',
                'phone' => '9620200492',
                'email' => 'namita.uw@mutualglobal.com',
            ],
            [
                'name' => 'Pallavi',
                'phone' => '7026300330',
                'email' => 'care@mutualglobal.com',
            ],
        ]);

        $employees = DB::table('employees')->get();
        foreach ($employees as $employee) {
            $uuid = Uuid::uuid4()->toString();
            DB::table('employees')->where('id', $employee->id)->update(['uuid' => $uuid]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
