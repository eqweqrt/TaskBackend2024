<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);

        $admin = User::factory()->create([
            'name' => 'admin',
            'surname' => 'admin',
            'email' => 'admin@shop.ru',
            'password' => Hash::make('QWEasd123'),
        ]);

        $admin->save();

        $user = User::factory()->create([
            'name' => 'user',
            'surname' => 'user',
            'email' => 'user@shop.ru',
            'password' => Hash::make('password'),
        ]);

        $user->save();

        $admin->assignRole('admin');
    }
}
