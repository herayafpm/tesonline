<?php

namespace App\Controllers\Api\V1\Admin;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserJawabansModel;

class Soal extends ResourceController
{

  protected $format       = 'json';
  protected $modelName    = 'App\Models\SoalsModel';

  public function index()
  {
    try {
      $dataGet = $this->request->getGet();
      $limit = $dataGet["limit"] ?? 10;
      $offset = $dataGet["offset"] ?? 0;
      $soals = $this->model->filter($limit, $offset);
      return $this->respond(["status" => 1, "message" => "berhasil mengambil data soal", "data" => $soals], 200);
    } catch (\Exception $th) {
      return $this->respond(["status" => 0, "message" => $th->getMessage(), "data" => []], 500);
    }
  }
  public function show($id = NULL)
  {
    try {
      $soal = $this->model->find($id);
      return $this->respond(["status" => 1, "message" => "berhasil mengambil data soal", "data" => $soal], 200);
    } catch (\Exception $th) {
      return $this->respond(["status" => 0, "message" => $th->getMessage(), "data" => []], 500);
    }
  }
  public function set_status($id = NULL)
  {
    try {
      $dataGet = $this->request->getGet();
      $status = (bool) $dataGet["status"];
      $update = $this->model->where(['soal_id' => $id])->set(['soal_status' => ($status) ? 1 : 0])->update();
      if ($update) {
        return $this->respond(["status" => 1, "message" => "soal dan jawaban berhasil diubah", "data" => []], 200);
      } else {
        return $this->respond(["status" => 0, "message" => "soal dan jawaban gagal diubah", "data" => []], 400);
      }
    } catch (\Exception $th) {
      return $this->respond(["status" => 0, "message" => $th->getMessage(), "data" => []], 500);
    }
  }
  public function create()
  {
    try {
      $validation =  \Config\Services::validation();
      $rule = [
        'soal_isi' => [
          'label'  => 'Soal',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'jawaban_a' => [
          'label'  => 'Jawaban A',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'jawaban_b' => [
          'label'  => 'Jawaban B',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'jawaban_c' => [
          'label'  => 'Jawaban C',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'jawaban_d' => [
          'label'  => 'Jawaban D',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'kunci_jawaban' => [
          'label'  => 'Kunci Jawaban',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
      ];
      $dataJson = $this->request->getJson();
      $data = [
        'soal_isi' => htmlspecialchars($dataJson->soal_isi ?? ''),
        'jawaban_a' => htmlspecialchars($dataJson->jawaban_a ?? ''),
        'jawaban_b' => htmlspecialchars($dataJson->jawaban_b ?? ''),
        'jawaban_c' => htmlspecialchars($dataJson->jawaban_c ?? ''),
        'jawaban_d' => htmlspecialchars($dataJson->jawaban_d ?? ''),
        'kunci_jawaban' => htmlspecialchars($dataJson->kunci_jawaban ?? ''),
        'soal_status' => htmlspecialchars($dataJson->soal_status ?? 0),
      ];
      $validation->setRules($rule);
      if (!$validation->run($data)) {
        return $this->respond(["status" => 0, "message" => "validasi error", "data" => $validation->getErrors()], 400);
      }
      $create = $this->model->save($data);
      if ($create) {
        return $this->respond(["status" => 1, "message" => "soal dan jawaban berhasil ditambahkan", "data" => []], 200);
      } else {
        return $this->respond(["status" => 0, "message" => "soal dan jawaban gagal ditambahkan", "data" => []], 400);
      }
    } catch (\Exception $th) {
      return $this->respond(["status" => 0, "message" => $th->getMessage(), "data" => []], 500);
    }
  }
  public function update($id = NULL)
  {
    try {
      $soal = $this->model->find($id);
      if (!$soal) {
        return $this->respond(["status" => 0, "message" => "Soal tidak ditemukan", "data" => []], 400);
      }
      $validation =  \Config\Services::validation();
      $rule = [
        'soal_isi' => [
          'label'  => 'Soal',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'jawaban_a' => [
          'label'  => 'Jawaban A',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'jawaban_b' => [
          'label'  => 'Jawaban B',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'jawaban_c' => [
          'label'  => 'Jawaban C',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'jawaban_d' => [
          'label'  => 'Jawaban D',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
        'kunci_jawaban' => [
          'label'  => 'Kunci Jawaban',
          'rules'  => 'required',
          'errors' => [
            'required' => '{field} tidak boleh kosong',
          ]
        ],
      ];
      $dataJson = $this->request->getJson();
      $data = [
        'soal_isi' => htmlspecialchars($dataJson->soal_isi ?? ''),
        'jawaban_a' => htmlspecialchars($dataJson->jawaban_a ?? ''),
        'jawaban_b' => htmlspecialchars($dataJson->jawaban_b ?? ''),
        'jawaban_c' => htmlspecialchars($dataJson->jawaban_c ?? ''),
        'jawaban_d' => htmlspecialchars($dataJson->jawaban_d ?? ''),
        'kunci_jawaban' => htmlspecialchars($dataJson->kunci_jawaban ?? ''),
        'soal_status' => htmlspecialchars($dataJson->soal_status ?? 0),
      ];
      $validation->setRules($rule);
      if (!$validation->run($data)) {
        return $this->respond(["status" => 0, "message" => "validasi error", "data" => $validation->getErrors()], 400);
      }
      $update = $this->model->update($id, $data);
      if ($update) {
        return $this->respond(["status" => 1, "message" => "Soal berhasil diubah", "data" => []], 200);
      } else {
        return $this->respond(["status" => 0, "message" => "Soal gagal diubah", "data" => []], 400);
      }
    } catch (\Exception $th) {
      return $this->respond(["status" => 0, "message" => $th->getMessage(), "data" => []], 500);
    }
  }
  public function delete($id = NULL)
  {
    try {
      $soal = $this->model->find($id);
      if (!$soal) {
        return $this->respond(["status" => 0, "message" => "Soal tidak ditemukan", "data" => []], 400);
      }
      $userJawabansModel = new UserJawabansModel();
      $cek =  $userJawabansModel->where(['soal_id' => $id])->first();
      if ($cek) {
        $update = $this->model->update($id, ['soal_status' => 0]);
        if ($update) {
          return $this->respond(["status" => 1, "message" => "Soal berhasil diubah menjadi nonaktif", "data" => []], 200);
        } else {
          return $this->respond(["status" => 0, "message" => "Soal gagal diubah menjadi nonaktif", "data" => []], 400);
        }
      }
      $delete = $this->model->delete($id);
      if ($delete) {
        return $this->respond(["status" => 1, "message" => "Soal berhasil dihapus", "data" => []], 200);
      } else {
        return $this->respond(["status" => 0, "message" => "Soal gagal dihapus", "data" => []], 400);
      }
    } catch (\Exception $th) {
      return $this->respond(["status" => 0, "message" => $th->getMessage(), "data" => []], 500);
    }
  }
}
