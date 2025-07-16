<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PostModel;
use CodeIgniter\HTTP\RedirectResponse;

class PostAdminController extends BaseController
{
    public function index()
    {
        $postModel = new PostModel();
        $posts = $postModel->orderBy('created_at', 'DESC')->findAll();
        return view('admin/posts/index', ['posts' => $posts]);
    }

    public function create()
    {
        return view('admin/posts/create');
    }

    public function store()
    {
        $validation = service('validation');
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'content' => 'required|min_length[10]',
            'category' => 'required|min_length[3]|max_length[100]',
            'image' => 'permit_empty|valid_url',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $postModel = new PostModel();
        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'category' => $this->request->getPost('category'),
            'image' => $this->request->getPost('image'),
        ];
        $postModel->insert($data);
        return redirect()->to('/admin/posts')->with('message', 'Artículo creado correctamente');
    }

    public function edit($id)
    {
        $postModel = new PostModel();
        $post = $postModel->find($id);
        if (!$post) {
            return redirect()->to('/admin/posts')->with('error', 'Artículo no encontrado');
        }
        return view('admin/posts/edit', ['post' => $post]);
    }

    public function update($id)
    {
        $validation = service('validation');
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'content' => 'required|min_length[10]',
            'category' => 'required|min_length[3]|max_length[100]',
            'image' => 'permit_empty|valid_url',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $postModel = new PostModel();
        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'category' => $this->request->getPost('category'),
            'image' => $this->request->getPost('image'),
        ];
        $postModel->update($id, $data);
        return redirect()->to('/admin/posts')->with('message', 'Artículo actualizado correctamente');
    }

    public function delete($id)
    {
        $postModel = new PostModel();
        $postModel->delete($id);
        return redirect()->to('/admin/posts')->with('message', 'Artículo eliminado correctamente');
    }
}
