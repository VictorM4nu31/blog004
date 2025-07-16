<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateShieldAuth extends Migration
{
    public function up()
    {
        // Ejecutar las migraciones de Shield
        $migration = \Config\Services::migrations();
        $migration->setNamespace('CodeIgniter\Shield');
        $migration->latest();
    }

    public function down()
    {
        // Revertir las migraciones de Shield
        $migration = \Config\Services::migrations();
        $migration->setNamespace('CodeIgniter\Shield');
        $migration->regress(0);
    }
}
