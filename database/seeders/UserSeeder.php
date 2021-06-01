<?php

namespace Database\Seeders;

use App\Models\admins;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        User::create([
            'name' => 'user1',
            'email' => 'user1@gmail.com',
            'username' => 'user1login',
            'profile_image' => 'fotouser',
            'level' => 'user',
            'phone' => '081789876666',            
            'password' => bcrypt('user12345'),
            'remember_token' => Str::random(60),
        ]);
    }
}
