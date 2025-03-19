<?php

namespace Database\Seeders;

use App\Models\KamarKos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KamarKosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KamarKos::create([
            'name' => 'Kamar 1',
            'description' => 'Kamar 1',
            'price' => 1000000,
            'available' => true
        ]);
        KamarKos::create([
            'name' => 'Kamar 2',
            'description' => 'Kamar 2',
            'price' => 1500000,
            'available' => true
        ]);
    }
}
