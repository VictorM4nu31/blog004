<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImageToCategories extends Migration
{
    public function up()
    {
        $this->forge->addColumn('categories', [
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'name'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('categories', 'image');
    }
}
