<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'superadmin@cateringme.com',
            'password' => Hash::make('qweqweqwe'),
            'role' => 'Admin',
            'number_phone' => '089630310313',
            'code_number' => 'ADM0001',
            'address' => 'Null',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
