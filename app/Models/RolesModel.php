<?php

namespace App\Models;

use CodeIgniter\Model;

class RolesModel extends Model
{
  protected $table      = 'roles';
  protected $primaryKey = 'role_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['role_nama'];

  protected $useTimestamps = false;
}
