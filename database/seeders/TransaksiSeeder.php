<?php

namespace Database\Seeders;

use App\Models\KamarKos;
use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kamar = KamarKos::first();

        Transaksi::create([
            'penyewa_id' => 1,
            'kamar_id' => $kamar->id,
            'check_in' => date('Y-m-d'),
            'check_out' => date('Y-m-d', strtotime('+1 months')),
            'total_price' => $kamar->price,
            'status' => 'pending',
            'komentar' => '-',
        ]);
    }
}
