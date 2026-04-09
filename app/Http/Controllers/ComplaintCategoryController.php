<?php

namespace App\Http\Controllers;

use App\Models\ComplaintCategory;
use Illuminate\Http\Request;

class ComplaintCategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => ComplaintCategory::orderBy('nama')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required|string|max:50|unique:complaint_categories,nama']);
        ComplaintCategory::create($request->only('nama'));
        return back()->with('success', 'Kategori ditambahkan');
    }

    public function update(Request $request, ComplaintCategory $category)
    {
        $request->validate(['nama' => 'required|string|max:50|unique:complaint_categories,nama,' . $category->id]);
        $category->update($request->only('nama'));
        return back()->with('success', 'Kategori diperbarui');
    }

    public function destroy(ComplaintCategory $category)
    {
        if ($category->isInUse()) {
            return back()->with('error', 'Kategori sedang digunakan');
        }

        $category->delete();
        return back()->with('success', 'Kategori dihapus');
    }
}
