<?php

namespace App\Validations;

use App\Models\UsersModel;
use App\Models\LupaPasswordModel;

class MyRules
{
  // public function cek_pass(string $password, $id)
  // {
  //   $userModel = new \App\Models\UserModel();
  //   $user = $userModel->where('id', $id)->first();
  //   if (password_verify($password, $user['password'])) {
  //     return true;
  //   }
  //   return false;
  // }
  public function cek_username_exist(string $user_username)
  {
    $usersModel = new UsersModel();
    $useraktif = $usersModel->getUserByUsername($user_username);
    if ($useraktif) {
      return true;
    }
    return false;
  }
  public function cek_email_kode_exist(string $kode_otp, $user_email)
  {
    $lupaPasswordModel = new LupaPasswordModel();
    $data = [
      'user_email' => $user_email,
      'kode_otp' => $kode_otp
    ];
    return $lupaPasswordModel->cek_email_kode($data);
  }
  public function cek_email(string $user_email, $user_id = NULL)
  {
    $usersModel = new UsersModel();
    $user = $usersModel->getUserByEmail($user_email);
    if ($user_id == NULL) {
      if ($user) {
        return true;
      }
      return false;
    } else {
      $useraktif = $usersModel->find($user_id);
      if (!$user || $user_email == $useraktif['user_email']) {
        return true;
      }
      return false;
    }
  }
  // public function cek_pemilik_toko(string $userid)
  // {
  //   $tokoModel = new \App\Models\TokoModel();
  //   $toko = $tokoModel->where('user_id', $userid)->get()->getRow();
  //   if (!$toko) {
  //     return true;
  //   }
  //   return false;
  // }
}
