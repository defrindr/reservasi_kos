<?php

namespace App\Http\Services;

use App\Models\KamarKos;

class KamarKosService extends BaseServiceImp
{
  public function __construct()
  {
    parent::__construct(new KamarKos());
  }
}
