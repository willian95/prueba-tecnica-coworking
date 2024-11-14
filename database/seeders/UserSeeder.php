<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $firstUser = "user1@gmail.com";
        $secondUser = "user2@gmail.com";
        $adminUser = "admin@gmail.com";

        if(User::where("email", $firstUser)->exists()) return;

        $user = new User();
        $user->name = "User 1";
        $user->email = $firstUser;
        $user->email_verified_at = now();
        $user->password = bcrypt("12345678");
        $user->save();

        if(User::where("email", $secondUser)->exists()) return;

        $user = new User();
        $user->name = "User 2";
        $user->email = $secondUser;
        $user->email_verified_at = now();
        $user->password = bcrypt("12345678");
        $user->save();

        if(User::where("email", $adminUser)->exists()) return;

        $user = new User();
        $user->name = "admin";
        $user->email = $adminUser;
        $user->email_verified_at = now();
        $user->password = bcrypt("12345678");
        $user->role = 'admin';
        $user->save();



    }
}
