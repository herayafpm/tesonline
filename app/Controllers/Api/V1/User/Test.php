<?php

namespace App\Controllers\Api\V1\User;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserJawabansModel;
use App\Models\SoalsModel;

class Test extends ResourceController
{

  protected $format       = 'json';
  protected $modelName    = 'App\Models\UserTestsModel';

  public function index()
  {
    try {
      $user = $this->request->user;
      $test = $this->model->where(['user_id' => $user->user_id])->first();
      return $this->respond(["status" => 1, "message" => "berhasil mengambil data test", "data" => $test], 200);
    } catch (\Exception $th) {
      return $this->respond(["status" => 0, "message" => $th->getMessage(), "data" => []], 500);
    }
  }

  public function create()
  {
    $user = $this->request->user;
    $dataJson = $this->request->getJson();
    $test = $this->model->where(['user_id' => $user->user_id])->first();
    if ($test) {
      $this->model->delete($test['user_test_id']);
    }
    $save = $this->model->save(['user_id' => $user->user_id]);
    if ($save) {
      $user_test_id = $this->model->InsertID();
      $no = 0;
      $userJawabansModel = new UserJawabansModel();
      $soalsModel = new SoalsModel();
      $insertUserJawabans = [];
      $benar = 0;
      foreach ($dataJson->soals as $soals) {
        $soal = $soalsModel->find($soals);
        if ($dataJson->jawabans[$no] == $soal['kunci_jawaban']) {
          $benar += 1;
        }
        array_push($insertUserJawabans, [
          'user_test_id' => $user_test_id,
          'soal_id' => $soals,
          'jawaban' => $dataJson->jawabans[$no],
        ]);
        $no++;
      }
      if ($userJawabansModel->insertBatch($insertUserJawabans)) {
        $hasil = (int) (100 / sizeof($dataJson->soals) * $benar);
        $this->model->update($user_test_id, ['user_test_score' => $hasil]);
        return $this->respond(["status" => 1, "message" => "berhasil melakukan tes, anda mendapatkan score {$hasil}", "data" => []], 200);
      } else {
        $this->model->delete($user_test_id);
        return $this->respond(["status" => 0, "message" => "gagal melakukan tes", "data" => []], 400);
      }
    } else {
      return $this->respond(["status" => 0, "message" => "gagal melakukan tes", "data" => []], 400);
    }
  }
}
