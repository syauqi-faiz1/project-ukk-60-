<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;

class AdminUserController extends Controller
{
    protected function getKelasOptions()
    {
        return Kelas::pluck('nama');
    }

    public function index()
    {
        return view('admin.siswa_pending', [
            'pendingSiswa' => User::where('status', 'pending')->get(),
            'stats' => User::getStats(),
        ]);
    }

    public function approve(User $siswa)
    {
        $siswa->update(['status' => 'approved', 'approved_at' => now()]);
        return back()->with('success', 'Akun disetujui');
    }

    public function create()
    {
        return view('admin.siswa_create', ['kelasOptions' => $this->getKelasOptions()]);
    }

    public function dataSiswa()
    {
        return view('admin.siswa_data', [
            'siswa' => User::where('role', 'siswa')->latest()->get(),
            'stats' => User::getStats(),
            'kelasOptions' => $this->getKelasOptions(),
        ]);
    }

    public function store()
    {
        $kelas = $this->getKelasOptions()->join(',');
        $v = request()->validate([
            'nama' => 'required',
            'nis' => 'required|unique:users,nis',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'kelas' => 'required|in:' . $kelas,
        ]);

        $v['password'] = bcrypt($v['password']);
        $v += ['status' => 'approved', 'role' => 'siswa'];

        User::create($v);

        return redirect()->route('admin.users.data')->with('success', 'Akun siswa berhasil dibuat');
    }

    public function deleteSiswa(User $siswa)
    {
        $siswa->delete();
        return response()->json(['success' => true]);
    }
}
