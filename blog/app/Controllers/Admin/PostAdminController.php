<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PostModel;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\RedirectResponse;

class PostAdminController extends BaseController
{
    // La verificación de autenticación se maneja por el filtro 'session'

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
        
        return view('admin/posts/index', ['posts' => $posts, 'categoryMap' => $categoryMap]);
    }

    public function create()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->orderBy('name', 'ASC')->findAll();
        return view('admin/posts/create', ['categories' => $categories]);
    }

    public function store()
    {
        $validation = service('validation');
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'content' => 'required|min_length[10]',
            'category_id' => 'required|is_natural_no_zero',
            'image' => 'max_size[image,5120]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/gif]'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $postModel = new PostModel();
        $imagePath = null;

        // Procesar la imagen si se subió
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Crear directorio si no existe
            $uploadPath = FCPATH . 'writable/uploads/posts/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Generar nombre único para la imagen
            $newName = $image->getRandomName();
            $image->move($uploadPath, $newName);
            $imagePath = 'uploads/posts/' . $newName;
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'category_id' => $this->request->getPost('category_id'),
            'image' => $imagePath,
        ];
        $postModel->insert($data);
        return redirect()->to('/admin/posts')->with('message', 'Post creado correctamente');
    }

    public function edit($id)
    {
        $postModel = new PostModel();
        $post = $postModel->find($id);
        if (!$post) {
            return redirect()->to('/admin/posts')->with('error', 'Post no encontrado');
        }
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->orderBy('name', 'ASC')->findAll();
        return view('admin/posts/edit', ['post' => $post, 'categories' => $categories]);
    }

    public function update($id)
    {
        $validation = service('validation');
        $rules = [
            'title' => 'required|min_length[3]|max_length[255]',
            'content' => 'required|min_length[10]',
            'category_id' => 'required|is_natural_no_zero',
            'image' => 'max_size[image,5120]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/gif]'
        ];
        if (! $this->validate($rules)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Errores de validación',
                    'errors' => $validation->getErrors()
                ]);
            }
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $postModel = new PostModel();
        $post = $postModel->find($id);
        if (!$post) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Post no encontrado'
                ]);
            }
            return redirect()->to('/admin/posts')->with('error', 'Post no encontrado');
        }

        $imagePath = $post['image']; // Mantener imagen existente por defecto

        // Procesar la nueva imagen si se subió
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $uploadPath = FCPATH . 'writable/uploads/posts/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            // Eliminar imagen anterior si existe
            if ($post['image'] && file_exists(FCPATH . 'writable/' . $post['image'])) {
                unlink(FCPATH . 'writable/' . $post['image']);
            }
            // Generar nombre único para la nueva imagen
            $newName = $image->getRandomName();
            $image->move($uploadPath, $newName);
            $imagePath = 'uploads/posts/' . $newName;
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'category_id' => $this->request->getPost('category_id'),
        ];
        // Solo actualizar imagen si hay nueva
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $data['image'] = $imagePath;
        }

        $postModel->update($id, $data);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Post actualizado correctamente'
            ]);
        }

        return redirect()->to('/admin/posts')->with('message', 'Post actualizado correctamente');
    }

    public function delete($id)
    {
        $postModel = new PostModel();
        $post = $postModel->find($id);
        
        if ($post && $post['image'] && file_exists(FCPATH . 'writable/' . $post['image'])) {
            unlink(FCPATH . 'writable/' . $post['image']);
        }
        
        $postModel->delete($id);
        return redirect()->to('/admin/posts')->with('message', 'Post eliminado correctamente');
    }
}
