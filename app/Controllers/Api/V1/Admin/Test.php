<?php

namespace App\Controllers\Api\V1\Admin;

use CodeIgniter\RESTful\ResourceController;

class Test extends ResourceController
{

  protected $format       = 'json';
  protected $modelName    = 'App\Models\UserTestsModel';

  public function index()
  {
    try {
      $dataGet = $this->request->getGet();
      $limit = $dataGet["limit"] ?? 10;
      $offset = $dataGet["offset"] ?? 0;
      $tests = $this->model->filter($limit, $offset);
      return $this->respond(["status" => 1, "message" => "berhasil mengambil data test", "data" => $tests], 200);
    } catch (\Exception $th) {
      return $this->respond(["status" => 0, "message" => $th->getMessage(), "data" => []], 500);
    }
  }
}
