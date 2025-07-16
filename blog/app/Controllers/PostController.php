<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PostModel;

class PostController extends BaseController
{
    public function index()
    {
        $postModel = new PostModel();
        $posts = $postModel->orderBy('created_at', 'DESC')->findAll();
        return view('posts/index', ['posts' => $posts]);
    }
}
