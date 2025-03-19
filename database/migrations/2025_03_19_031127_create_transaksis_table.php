<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penyewa_id')->constrained('penyewas');
            $table->foreignId('kamar_id')->constrained('kamar_kos');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('total_price');
            $table->string('transfer_photo')->nullable();
            $table->enum('status', ['pending', 'menunggu pembayaran', 'selesai', 'dibatalkan']);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
