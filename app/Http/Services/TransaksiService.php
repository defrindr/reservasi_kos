<?php

namespace App\Http\Services;

use App\Models\KamarKos;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiService extends BaseServiceImp
{
  protected $roomModel;
  public function __construct()
  {
    parent::__construct(new Transaksi());
    $this->roomModel = new KamarKos();
  }

  public function bookRoom(string $id)
  {
    try {
      DB::beginTransaction();
      $userId = Auth::id();
      $user = User::findOrFail($userId);
      if (!$user) {
        throw new \Exception('User not found');
      }

      $penyewa = $user->penyewa;
      if (!$penyewa) {
        throw new \Exception('Penyewa not found');
      }

      $room = $this->roomModel->findOrFail($id);

      // Check Available Room
      if (!$room->available) {
        throw new \Exception('Kamar ini sedang tidak tersedia');
      }

      // Check if already booking and checkout is inside date
      $isBooked = $this->model
        ->where('penyewa_id', $penyewa->id)
        ->where('kamar_id', $id)
        ->where('check_in', '<', now())
        ->where('check_out', '>', now())
        ->exists();

      if ($isBooked) {
        throw new \Exception('Anda telah memesan kamar ini');
      }

      // Booking room
      $this->roomModel
        ->where('id', $id)
        ->update(['available' => 0]);

      $checkIn = now();
      $checkOut = Carbon::parse($checkIn)->addMonths(1);

      $totalPrice = $room->price;
      $data = [
        'penyewa_id' => $penyewa->id,
        'kamar_id' => $id,
        'check_in' => $checkIn,
        'check_out' => $checkOut,
        'total_price' => $totalPrice,
        'status' => 'pending',
        'komentar' => 'Pesanan sedang diproses',
      ];

      $success = $this->model->create($data);
      DB::commit();
      return $success;
    } catch (\Throwable $th) {
      throw new \Exception($th->getMessage());
    }
  }

  public function cancelBooking(string $id)
  {
    try {
      DB::beginTransaction();
      $transaksi = $this->model->findOrFail($id);
      $room = $this->roomModel->findOrFail($transaksi->kamar_id);

      $transaksi->delete();
      $room->update(['available' => 1]);
      DB::commit();
      return true;
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }
  }

  public function fetchByStatus(
    ?string $status,
    string $search,
    string $orderBy,
    string $orderDirection,
    int $limit = 10,
    bool $paginate = true
  ) {
    $query = $this->model->query();
    if ($status) {
      $query = $query->where('status', $status);
    }

    $this->query = $query;
    return parent::fetch(
      $search,
      $orderBy,
      $orderDirection,
      $limit,
      $paginate
    );
  }

  public function getMyTrx()
  {
    $userId = Auth::id();
    $user = User::findOrFail($userId);
    $penyewa = $user->penyewa;
    $query = $this->model;
    if ($penyewa) {
      $query = $query->where('penyewa_id', $penyewa->id);
    }


    return $query
      ->orderBy('created_at', 'desc')
      ->paginate();
  }

  public function getListAvailableRooms()
  {
    return $this->roomModel->where('available', 1)->paginate();
  }

  public function getNeedConfirmation()
  {
    return $this->model
      ->where('status', 'pending')
      ->paginate();
  }

  public function confirm(string $id)
  {
    DB::beginTransaction();
    try {
      $transaksi = $this->model->findOrFail($id);
      $transaksi->update(['status' => 'menunggu pembayaran']);
      DB::commit();
      return true;
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }
  }

  public function getNeedPayment()
  {
    return $this->model->where('status', 'menunggu pembayaran')->get();
  }

  public function submitBuktiTf(string $id, UploadedFile $file)
  {
    DB::beginTransaction();
    try {
      $transaksi = $this->model->findOrFail($id);
      $path = $file->store('public/transfer_photo');
      // remove public/
      $path = str_replace('public/', '', $path);

      $transaksi->update([
        'transfer_photo' => $path,
        'status' => 'konfirmasi pembayaran',
      ]);
      DB::commit();
      return true;
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }
  }

  public function getNeedConfirmationPayment()
  {
    return $this->model->where('status', 'konfirmasi pembayaran')->get();
  }

  public function confirmPayment(string $id)
  {
    DB::beginTransaction();
    try {
      $transaksi = $this->model->findOrFail($id);
      $transaksi->update(['status' => 'selesai']);
      DB::commit();
      return true;
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }
  }

  public function reject($id, $komentar = "")
  {
    DB::beginTransaction();
    try {
      $transaksi = $this->model->findOrFail($id);
      $transaksi->update([
        'status' => 'ditolak',
        'komentar' => 'Dibatalkan oleh admin karena ' . $komentar,
      ]);
      DB::commit();
      return true;
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }
  }

  public function getCanceled()
  {
    return $this->model->where('status', 'dibatalkan')->get();
  }

  public function cancel(string $id)
  {
    DB::beginTransaction();
    try {
      $transaksi = $this->model->findOrFail($id);
      $transaksi->update(['status' => 'dibatalkan']);
      DB::commit();
      return true;
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }
  }
}
