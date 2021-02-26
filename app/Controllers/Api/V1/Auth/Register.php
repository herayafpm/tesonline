<?php

namespace App\Controllers\Api\V1\Auth;

use CodeIgniter\RESTful\ResourceController;

class Register extends ResourceController
{

  protected $format       = 'json';
  protected $modelName    = 'App\Models\UsersModel';

  public function index()
  {
    $validation =  \Config\Services::validation();
    $rules = [
      'user_username' => [
        'label'  => 'Username',
        'rules'  => 'required|is_unique[users.user_username]',
        'errors' => [
          'required' => '{field} tidak boleh kosong',
          'is_unique' => '{field} sudah digunakan',
        ]
      ],
      'user_nama' => [
        'label'  => 'Nama Lengkap',
        'rules'  => 'required',
        'errors' => [
          'required' => '{field} tidak boleh kosong',
        ]
      ],
      'user_email' => [
        'label'  => 'Email',
        'rules'  => 'required|is_unique[users.user_email]',
        'errors' => [
          'required' => '{field} tidak boleh kosong',
          'is_unique' => '{field} sudah digunakan',
        ]
      ],
      'user_password' => [
        'label'  => 'Password',
        'rules'  => 'required|min_length[6]',
        'errors' => [
          'required' => '{field} tidak boleh kosong',
          'min_length' => '{field} harus lebih dari sama dengan {param} karakter',
        ]
      ],
    ];
    $dataJson = $this->request->getJson();
    $data = [
      'user_username' => htmlspecialchars($dataJson->user_username ?? ''),
      'user_nama' => htmlspecialchars($dataJson->user_nama ?? ''),
      'user_email' => htmlspecialchars($dataJson->user_email ?? ''),
      'user_password' => htmlspecialchars($dataJson->user_password ?? ''),
    ];
    $validation->setRules($rules);
    if (!$validation->run($data)) {
      return $this->respond(["status" => 0, "message" => "Validasi gagal", "data" => $validation->getErrors()], 400);
    }
    $data['role_id'] = 2;
    $save = $this->model->save($data);
    if ($save) {
      return $this->respond(["status" => 1, "message" => "berhasil mendaftar,silahkan masuk", "data" => []], 200);
    } else {
      return $this->respond(["status" => 0, "message" => "gagal mendaftar", "data" => []], 400);
    }
  }
}
