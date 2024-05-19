<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        User::truncate();

        User::create([
            'name' => 'admin',
            'email' => 'kpa80.design@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'role' => 2
        ]);
        UserFactory::times(25)->create();
        Schema::enableForeignKeyConstraints();
    }
}
