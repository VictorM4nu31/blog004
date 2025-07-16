<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCategoryIdToPosts extends Migration
{
    public function up()
    {
        $this->forge->addColumn('posts', [
            'category_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
                'after'      => 'id'
            ]
        ]);
        $this->forge->dropColumn('posts', 'category');
    }

    public function down()
    {
        $this->forge->addColumn('posts', [
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
                'after'      => 'image'
            ]
        ]);
        $this->forge->dropColumn('posts', 'category_id');
    }
}
