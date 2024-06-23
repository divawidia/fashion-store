<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\models\admin;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        admin::create([
            'name' => 'admin1',
            'email' => 'admin1@gmail.com',
            'username' => 'admin1login',
            'profile_image' => 'fotoadmin',
            'phone' => '088789876678',
            'password' => bcrypt('12345'),
            'remember_token' => Str::random(60),
        ]);
    }
}
