<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AuthRedirectController extends Controller
{
    public function loginRedirect()
    {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->to('/login');
        }
        
        // Verificar si el usuario tiene permisos de admin
        if ($user->can('admin.access') || $user->can('blog.posts.create')) {
            return redirect()->to('/admin/posts');
        }
        
        // Si es usuario regular, redirigir al dashboard de usuario
        return redirect()->to('/user/dashboard');
    }
}
