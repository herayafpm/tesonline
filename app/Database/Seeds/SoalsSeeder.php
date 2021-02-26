<?php

namespace App\Database\Seeds;

class SoalsSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $initDatas = [
      [
        "soal_isi" => "Bahasa Pemrograman Apa yang digunakan Flutter?",
        "jawaban_a" => "PHP",
        "jawaban_b" => "Dart",
        "jawaban_c" => "Java",
        "jawaban_d" => "Javascript",
        "kunci_jawaban" => 'b'
      ],
      [
        "soal_isi" => "Flutter bisa digunakan untuk membuat?",
        "jawaban_a" => "Android",
        "jawaban_b" => "Ios",
        "jawaban_c" => "Web",
        "jawaban_d" => "Semua benar",
        "kunci_jawaban" => 'd'
      ],
    ];
    $this->db->table('soals')->insertBatch($initDatas);
  }
}
