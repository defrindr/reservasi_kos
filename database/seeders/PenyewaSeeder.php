<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenyewaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Penyewa',
            'last_name' => '-',
            'email' => 'penyewa@gmail.com',
            'password' => 'password',
            'role' => 'user',
        ]);

        $user->penyewa()->create([
            'name' => 'Penyewa',
            'address' => 'Jl. Penyewa',
            'phone_number' => '081234567890'
        ]);
    }
}
