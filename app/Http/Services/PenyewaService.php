<?php

namespace App\Http\Services;

use App\Models\Penyewa;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PenyewaService extends BaseServiceImp
{
  public function __construct()
  {
    parent::__construct(new Penyewa());
  }

  public function store(array $payload)
  {

    DB::beginTransaction();

    $createUser = User::create([
      'name' => $payload['name'],
      'last_name' => '-',
      'email' => $payload['email'],
      'password' =>  $payload['password'],
      'role_id' => 'user', // default role: admin
    ]);
    if (!$createUser) {
      DB::rollBack();
      return false;
    }

    $payload['user_id'] = $createUser->id;

    $successCreate =  $this->model->create($payload);
    if (!$successCreate) {
      DB::rollBack();
      return false;
    }

    DB::commit();
    return true;
  }

  public function update(array $payload, string $id)
  {
    DB::beginTransaction();

    $penyewa = $this->model->where('id', $id)->first();
    if (!$penyewa) {
      DB::rollBack();
      return false;
    }

    $successUpdate = $penyewa->update($payload);
    if (!$successUpdate) {
      DB::rollBack();
      return false;
    }

    $user = User::where('id', $penyewa->user_id)->first();
    if (!$user) {
      DB::rollBack();
      return false;
    }

    $userPayload = [
      'name' => $payload['name'],
      'email' => $payload['email'],
    ];
    if (isset($payload['password'])) {
      $userPayload['password'] = $payload['password'];
    }

    $success = $user->update($userPayload);
    if (!$success) {
      DB::rollBack();
      return false;
    }

    DB::commit();
    return true;
  }
}
