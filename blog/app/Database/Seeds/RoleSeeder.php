<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Models\UserModel;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $userModel = new UserModel();
        
        // Asignar rol admin si el usuario existe
        $admin = $userModel->findByCredentials(['email' => 'admin@blog.com']);
        if ($admin) {
            $admin->addGroup('admin');
            echo "Rol 'admin' asignado a admin@blog.com\n";
        } else {
            echo "Usuario admin@blog.com no encontrado.\n";
        }
        
        // Asignar rol user si el usuario existe
        $user = $userModel->findByCredentials(['email' => 'user@blog.com']);
        if ($user) {
            $user->addGroup('user');
            echo "Rol 'user' asignado a user@blog.com\n";
        } else {
            echo "Usuario user@blog.com no encontrado.\n";
        }
    }
}
