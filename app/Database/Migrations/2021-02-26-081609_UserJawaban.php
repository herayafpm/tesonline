<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserSoal extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'user_jawaban_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'user_test_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
			],
			'soal_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
			],
			'jawaban' => [
				'type' => 'VARCHAR',
				'constraint'     => 1,
			],
		]);
		$this->forge->addKey('user_jawaban_id', true);
		$this->forge->addForeignKey('soal_id', 'soals', 'soal_id');
		$this->forge->addForeignKey('user_test_id', 'user_tests', 'user_test_id', 'CASCADE', 'CASCADE');
		$this->forge->createTable('user_jawabans');
	}

	public function down()
	{
		$this->forge->dropTable('user_jawabans');
	}
}
