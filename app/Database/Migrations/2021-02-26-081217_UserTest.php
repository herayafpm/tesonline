<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserTest extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'user_test_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'user_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
			],
			'user_test_score' => [
				'type' => 'INT',
				'constraint'     => 11,
				'default'					=> 0
			],
			'user_test_created_at'       => [
				'type'           => 'TIMESTAMP',
				'default' => date('Y-m-d H:i:s')
			],
		]);
		$this->forge->addKey('user_test_id', true);
		$this->forge->addForeignKey('user_id', 'users', 'user_id');
		$this->forge->createTable('user_tests');
	}

	public function down()
	{
		$this->forge->dropTable('user_tests');
	}
}
