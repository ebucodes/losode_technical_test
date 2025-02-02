<?php

namespace Database\Seeders;

use App\Enums\UserRolesEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $items = [
            ["name" => "Business Example", "email" => "business@example.com", "password" => "password"],
        ];



        foreach ($items as $item) {
            if (User::where('email', $item['email'])->exists()) {
                continue;
            }

            // User::create($item);
            User::create([
                "uuid" => Str::uuid(),
                "name" => $item['name'],
                "email" => $item['email'],
                "password" => Hash::make($item['password']),
                "role" => UserRolesEnum::BUSINESS,
            ]);
        }
    }
}
