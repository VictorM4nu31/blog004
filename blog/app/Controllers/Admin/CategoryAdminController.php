<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use CodeIgniter\HTTP\RedirectResponse;

class CategoryAdminController extends BaseController
{
    // La verificación de autenticación se maneja por el filtro 'session'

    public function index()
    {
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->orderBy('name', 'ASC')->findAll();
        return view('admin/categories/index', ['categories' => $categories]);
    }
    public function create()
    {
        return view('admin/categories/create');
    }

    public function store()
    {
        $validation = service('validation');
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]|is_unique[categories.name]',
            'image' => 'uploaded[image]|max_size[image,5120]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/gif]'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $categoryModel = new CategoryModel();
        $imagePath = null;

        // Procesar la imagen si se subió
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Crear directorio si no existe
            $uploadPath = FCPATH . 'writable/uploads/categories/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Generar nombre único para la imagen
            $newName = $image->getRandomName();
            $image->move($uploadPath, $newName);
            $imagePath = 'uploads/categories/' . $newName;
        }

        $categoryModel->insert([
            'name' => $this->request->getPost('name'),
            'image' => $imagePath,
        ]);
        return redirect()->to('/admin/categories')->with('message', 'Categoría creada correctamente');
    }

    public function edit($id)
    {
        $categoryModel = new CategoryModel();
        $category = $categoryModel->find($id);
        if (!$category) {
            return redirect()->to('/admin/categories')->with('error', 'Categoría no encontrada');
        }
        return view('admin/categories/edit', ['category' => $category]);
    }

    public function update($id)
    {
        $validation = service('validation');
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]|is_unique[categories.name,id,{id}]',
            'image' => 'max_size[image,5120]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/gif]'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $categoryModel = new CategoryModel();
        $category = $categoryModel->find($id);
        if (!$category) {
            return redirect()->to('/admin/categories')->with('error', 'Categoría no encontrada');
        }

        $imagePath = $category['image']; // Mantener imagen existente por defecto

        // Procesar la nueva imagen si se subió
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Crear directorio si no existe
            $uploadPath = FCPATH . 'writable/uploads/categories/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            // Eliminar imagen anterior si existe
            if ($category['image'] && file_exists(FCPATH . 'writable/' . $category['image'])) {
                unlink(FCPATH . 'writable/' . $category['image']);
            }

            // Generar nombre único para la nueva imagen
            $newName = $image->getRandomName();
            $image->move($uploadPath, $newName);
            $imagePath = 'uploads/categories/' . $newName;
        }

        $categoryModel->update($id, [
            'name' => $this->request->getPost('name'),
            'image' => $imagePath,
        ]);
        return redirect()->to('/admin/categories')->with('message', 'Categoría actualizada correctamente');
    }

    public function delete($id)
    {
        $categoryModel = new CategoryModel();
        $category = $categoryModel->find($id);
        
        if ($category && $category['image'] && file_exists(FCPATH . 'writable/' . $category['image'])) {
            unlink(FCPATH . 'writable/' . $category['image']);
        }
        
        $categoryModel->delete($id);
        return redirect()->to('/admin/categories')->with('message', 'Categoría eliminada correctamente');
    }
}
