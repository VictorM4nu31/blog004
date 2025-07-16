<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Shield\Models\UserModel;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Crear usuario administrador
        $userModel = new UserModel();
        
        // Crear admin
        $admin = $userModel->findByCredentials(['email' => 'admin@blog.com']);
        if (!$admin) {
            $admin = new \CodeIgniter\Shield\Entities\User([
                'username' => 'admin',
                'email' => 'admin@blog.com',
                'password' => 'admin123',
            ]);
            $admin->activate();
            $userModel->save($admin);
            $admin = $userModel->findByCredentials(['email' => 'admin@blog.com']);
        }
        
        // Asignar al grupo admin
        $admin->addGroup('admin');
        
        // Crear usuario regular
        $user = $userModel->findByCredentials(['email' => 'user@blog.com']);
        if (!$user) {
            $user = new \CodeIgniter\Shield\Entities\User([
                'username' => 'user',
                'email' => 'user@blog.com',
                'password' => 'user123',
            ]);
            $user->activate();
            $userModel->save($user);
            $user = $userModel->findByCredentials(['email' => 'user@blog.com']);
        }
        
        // Asignar al grupo user (ya es el default)
        $user->addGroup('user');
        
        echo "Usuarios creados:\n";
        echo "Admin: admin@blog.com / admin123\n";
        echo "User: user@blog.com / user123\n";
    }
}
