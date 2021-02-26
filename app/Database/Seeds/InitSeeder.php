<?php

namespace App\Database\Seeds;

class InitSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $this->call('RolesSeeder');
    $this->call('UsersSeeder');
    $this->call('SoalsSeeder');
  }
}
