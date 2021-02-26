<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
  protected $table      = 'users';
  protected $primaryKey = 'user_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['user_nama', 'user_username', 'user_email', 'role_id', 'user_password'];

  protected $useTimestamps = true;
  protected $createdField  = 'user_created_at';
  protected $updatedField  = 'user_updated_at';
  protected $beforeInsert = ['hashPassword'];
  protected $beforeUpdate = ['hashPassword'];
  protected function hashPassword(array $data)
  {

    if (!isset($data['data']['user_password'])) return $data;
    $data['data']['user_password'] = password_hash($data['data']['user_password'], PASSWORD_DEFAULT);
    return $data;
  }
  public function lupaPassword($user_email, $user_password)
  {
    return $this->where('user_email', $user_email)->set(['user_password' => $user_password])->update();
  }
  public function getUserByEmail($user_email)
  {
    return $this->where('user_email', $user_email)->get()->getRow();
  }
  public function getUserByUsername($user_username)
  {
    return $this->where('user_username', $user_username)->get()->getRow();
  }
  public function getUserWithRole($user_username)
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.*");
    $builder->select("roles.*");
    $builder->join('roles', "roles.role_id = {$this->table}.role_id");
    $builder->where(['user_username' => $user_username]);
    $query = $builder->get()->getRow();
    return $query;
  }
  public function authenticate($user_username, $user_password)
  {
    $auth = $this->where('user_username', $user_username)->first();
    if ($auth) {
      if (password_verify($user_password, $auth['user_password'])) {
        return $this->getUserWithRole($auth['user_username']);
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
  public function cek_status($status)
  {
    return $status == 1;
  }
  public function getLastId()
  {
    return $this->insertID();
  }
}
