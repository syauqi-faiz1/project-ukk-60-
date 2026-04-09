<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\ComplaintCategory;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function siswaList()
    {
        return view('siswa.complaints.index', [
            'complaints' => Complaint::where('user_id', auth()->id())->latest()->get(),
            'stats' => Complaint::getStats(auth()->id()),
        ]);
    }

    public function siswaCreate()
    {
        return view('siswa.complaints.create', [
            'categories' => ComplaintCategory::orderBy('nama')->get(),
        ]);
    }

    public function siswaStore(Request $request)
    {
        $data = $request->validate([
            'kategori' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'image' => 'nullable|image',
        ]) + [
            'user_id' => auth()->id(),
            'status' => 'pending',
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('complaints', 'public');
        }

        Complaint::create($data);

        return redirect()->route('siswa.complaints.index')->with('success', 'Pengaduan berhasil dibuat');
    }

    public function siswaShow(Complaint $complaint)
    {
        abort_unless($complaint->user_id === auth()->id(), 403);

        return view('siswa.complaints.show', compact('complaint'));
    }

    public function adminList(Request $request)
    {
        $complaints = Complaint::with('user')
            ->when($request->status, fn ($q, $status) => $q->where('status', $status))
            ->when($request->kategori, fn ($q, $kategori) => $q->where('kategori', $kategori))
            ->when($request->order === 'lama', fn ($q) => $q->oldest('created_at'), fn ($q) => $q->latest());

        return view('admin.complaints.index', [
            'complaints' => $complaints->get(),
            'stats' => Complaint::getStats(),
            'kategoriList' => ComplaintCategory::orderBy('nama')->pluck('nama'),
        ]);
    }

    public function adminShow(Complaint $complaint)
    {
        return view('admin.complaints.show', ['complaint' => $complaint->load('user')]);
    }

    public function adminUpdateStatus(Request $request, Complaint $complaint)
    {
        $complaint->update(['status' => $request->status]);
        return back()->with('success', 'Status diperbarui');
    }

    public function adminUpdateFeedback(Request $request, Complaint $complaint)
    {
        $complaint->update(['feedback' => $request->feedback]);
        return back()->with('success', 'Feedback dikirim');
    }
}
