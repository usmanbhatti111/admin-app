<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
             
            'user_type' => 'admin',

            // 'email'=>'viewer@gmail.com',
            // 'password'=>'viewer@123',
            // 'usertype' => 'user',
             
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'name' => 'User',
            'email'=>'viewer@gmail.com', 
            'user_type' => 'user',
             
            'password' => bcrypt('admin'),
        ]);
    }
}
