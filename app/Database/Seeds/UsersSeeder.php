<?php

namespace App\Database\Seeds;

class UsersSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    // Users
    $password = password_hash("123456", PASSWORD_DEFAULT);
    $initDatas = [
      [
        'user_nama'       => "admin",
        'user_email'       => "herayafpm@gmail.com",
        'user_username'       => "admin",
        'role_id'       => 1,
        'user_password'       => $password,
      ],
      [
        'user_nama'       => "user",
        'user_email'       => "heraya71@gmail.com",
        'user_username'       => "user",
        'role_id'       => 2,
        'user_password'       => $password,
      ],
    ];

    $this->db->table('users')->insertBatch($initDatas);
  }
}
