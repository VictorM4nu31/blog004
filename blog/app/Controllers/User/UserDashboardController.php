<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\PostModel;
use App\Models\CategoryModel;

class UserDashboardController extends BaseController
{
    public function index()
    {
        $postModel = new PostModel();
        $posts = $postModel->orderBy('created_at', 'DESC')->findAll();
        
        // Obtener categorías para el mapeo
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->findAll();
        $categoryMap = [];
        foreach ($categories as $category) {
            $categoryMap[$category['id']] = $category['name'];
        }
        
        return view('user/dashboard', ['posts' => $posts, 'categoryMap' => $categoryMap]);
    }
}
