<?php

namespace App\Models;

use CodeIgniter\Model;

class UserTestsModel extends Model
{
  protected $table      = 'user_tests';
  protected $primaryKey = 'user_test_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['user_id', 'user_test_score'];

  protected $useTimestamps = true;
  protected $createdField  = 'user_test_created_at';
  protected $updatedField  = '';
  public function filter($limit, $start, $params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->orderBy($this->primaryKey, 'desc'); // Untuk menambahkan query ORDER BY
    $builder->limit($limit, $start); // Untuk menambahkan query LIMIT
    $builder->select("{$this->table}.*");
    $builder->select("users.*");
    $builder->join('users', "users.user_id = {$this->table}.user_id", 'LEFT');
    if (isset($params['where'])) {
      $builder->where($params['where']);
    }
    if (isset($params['like'])) {
      foreach ($params['like'] as $key => $value) {
        $builder->like($key, $value);
      }
    }
    $datas = $builder->get()->getResultArray();
    return $datas;
  }
}
