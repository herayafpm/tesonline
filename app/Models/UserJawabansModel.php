<?php

namespace App\Models;

use CodeIgniter\Model;

class UserJawabansModel extends Model
{
  protected $table      = 'user_jawabans';
  protected $primaryKey = 'user_jawaban_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['soal_id', 'user_test_id', 'jawaban'];

  protected $useTimestamps = false;
  public function filter($limit, $start, $params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->orderBy($this->primaryKey, 'desc');
    $builder->limit($limit, $start);
    $builder->select("{$this->table}.*");
    $builder->select("soals.*");
    $builder->join('soals', "soals.soal_id = {$this->table}.soal_id", 'LEFT');
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
