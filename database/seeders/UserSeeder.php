<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
<<<<<<< HEAD
            'email' => 'ruparasa002@gmail.com',
=======
            'email' => 'admin@contoh.com',
>>>>>>> b302f7085f1fc1bc4fee4453e6ab52673278ea7a
            'password' => Hash::make('1234567'),  // password default
            'role' => 'admin',
        ]);
       
    }
}
