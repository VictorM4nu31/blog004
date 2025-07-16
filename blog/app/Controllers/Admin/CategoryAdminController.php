<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoryModel;

class CategoryAdminController extends BaseController
{
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
            'name' => 'required|min_length[3]|max_length[100]|is_unique[categories.name]'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $categoryModel = new CategoryModel();
        $categoryModel->insert([
            'name' => $this->request->getPost('name'),
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
            'name' => 'required|min_length[3]|max_length[100]|is_unique[categories.name,id,{id}]'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $categoryModel = new CategoryModel();
        $categoryModel->update($id, [
            'name' => $this->request->getPost('name'),
        ]);
        return redirect()->to('/admin/categories')->with('message', 'Categoría actualizada correctamente');
    }

    public function delete($id)
    {
        $categoryModel = new CategoryModel();
        $categoryModel->delete($id);
        return redirect()->to('/admin/categories')->with('message', 'Categoría eliminada correctamente');
    }
}
