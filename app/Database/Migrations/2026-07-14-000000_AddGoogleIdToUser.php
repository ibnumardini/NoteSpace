<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGoogleIdToUser extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'google_id' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'email',
            ],
        ]);

        $this->db->query("ALTER TABLE users ADD UNIQUE INDEX users_google_id (google_id)");
        $this->db->query("ALTER TABLE users MODIFY COLUMN password_hash VARCHAR(255) NULL");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE users DROP INDEX users_google_id");
        $this->forge->dropColumn('users', 'google_id');
        $this->db->query("ALTER TABLE users MODIFY COLUMN password_hash VARCHAR(255) NOT NULL");
    }
}
