<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        return view('admin.kelas.index', ['kelas' => Kelas::orderBy('nama')->get()]);
    }

    public function create()
    {
        return view('admin.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required|unique:kelas,nama']);
        Kelas::create($request->only('nama'));
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function edit(Kelas $kela)
    {
        return view('admin.kelas.edit', compact('kela'));
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate(['nama' => 'required|unique:kelas,nama,' . $kela->id]);
        $kela->update($request->only('nama'));
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diperbarui');
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus');
    }
}
