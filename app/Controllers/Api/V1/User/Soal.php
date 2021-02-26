<?php

namespace App\Controllers\Api\V1\User;

use CodeIgniter\RESTful\ResourceController;

class Soal extends ResourceController
{

  protected $format       = 'json';
  protected $modelName    = 'App\Models\SoalsModel';

  public function index()
  {
    try {
      $soals = $this->model->where(['soal_status' => 1])->findColumn('soal_id') ?? [];
      return $this->respond(["status" => 1, "message" => "berhasil mengambil data soal", "data" => $soals], 200);
    } catch (\Exception $th) {
      return $this->respond(["status" => 0, "message" => $th->getMessage(), "data" => []], 500);
    }
  }
  public function show($id = NULL)
  {
    try {
      $soal = $this->model->where(['soal_id' => $id, 'soal_status' => 1])->first();
      if (!$soal) {
        return $this->respond(["status" => 0, "message" => "Soal tidak ditemukan", "data" => []], 400);
      }
      return $this->respond(["status" => 1, "message" => "berhasil mengambil data soal", "data" => $soal], 200);
    } catch (\Exception $th) {
      return $this->respond(["status" => 0, "message" => $th->getMessage(), "data" => []], 500);
    }
  }
}
