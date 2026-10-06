<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixUserTimestamps extends Migration
{
    public function up()
    {
        if (!$this->db->tableExists('users')) {
            return;
        }

        $fields = $this->db->getFieldNames('users');

        if (in_array('reated_at', $fields, true) && !in_array('created_at', $fields, true)) {
            $this->forge->modifyColumn('users', [
                'reated_at' => [
                    'name' => 'created_at',
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);
        } elseif (!in_array('created_at', $fields, true)) {
            $this->forge->addColumn('users', [
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);
        }

        if (!in_array('updated_at', $fields, true)) {
            $this->forge->addColumn('users', [
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);
        }
    }

    public function down()
    {
        if (!$this->db->tableExists('users')) {
            return;
        }

        $fields = $this->db->getFieldNames('users');

        if (in_array('created_at', $fields, true) && !in_array('reated_at', $fields, true)) {
            $this->forge->modifyColumn('users', [
                'created_at' => [
                    'name' => 'reated_at',
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);
        }
    }
}
