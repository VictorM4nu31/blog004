<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TruncateAllTables extends Seeder
{
    public function run()
    {
        // Desactivar claves foráneas
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0;');

        $tables = [
            'auth_groups_users',
            'auth_identities',
            'auth_logins',
            'auth_permissions_users',
            'auth_remember_tokens',
            'auth_token_logins',
            'categories',
            'posts',
            'users',
        ];
        foreach ($tables as $table) {
            $this->db->table($table)->truncate();
        }

        // Reactivar claves foráneas
        $this->db->query('SET FOREIGN_KEY_CHECKS = 1;');
    }
} 