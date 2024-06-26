<?php

namespace Database\Seeders;

use App\Helpers\UuidGeneratorHelper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Insert admin user with role_id
        $adminRoleId = DB::table('roles')->where('slug', 'admin')->value('id');

        $adminUser = User::create([
            'uuid' => UuidGeneratorHelper::generateUniqueUuidForTable('users'),
            'name' => 'Super Admin',
            'email' => env('SEEDER_ADMIN_EMAIL'),
            'phone' => '1234567890',
            'password' => Hash::make(env('SEEDER_ADMIN_PASSWORD')),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $adminUser->roles()->sync([$adminRoleId]);

        $this->command->info('User Seeder Done');
    }
}
