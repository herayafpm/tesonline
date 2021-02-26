<?php

namespace App\Database\Seeds;

class RolesSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $initDatas = [
      ["role_nama" => "admin"],
      ["role_nama" => "user"],
    ];
    $this->db->table('roles')->insertBatch($initDatas);
  }
}
