<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Soals extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'soal_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'soal_isi'       => [
				'type'           => 'TEXT',
			],
			'jawaban_a' => [
				'type'           => 'TEXT',
			],
			'jawaban_b' => [
				'type'           => 'TEXT',
			],
			'jawaban_c' => [
				'type'           => 'TEXT',
			],
			'jawaban_d' => [
				'type'           => 'TEXT',
			],
			'kunci_jawaban' => [
				'type'           => 'VARCHAR',
				'constraint'     => 1,
			],
			'soal_status' => [
				'type' => 'INT',
				'constraint'     => 1,
				'default'				=> 1
			],
		]);
		$this->forge->addKey('soal_id', true);
		$this->forge->createTable('soals');
	}

	public function down()
	{
		$this->forge->dropTable('soals');
	}
}
