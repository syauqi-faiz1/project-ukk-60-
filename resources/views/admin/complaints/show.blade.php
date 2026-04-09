@extends('layouts.admin')

@section('content')

<div class="bg-blue-600 text-white p-6 shadow border">
 <h1 class="text-3xl font-bold">Detail Pengaduan</h1>
</div>

<div class="p-6">
 <div class="max-w-4xl mx-auto">
  <!-- Complaint Info -->
  <div class="bg-white rounded shadow-md p-8 mb-6 border border-blue-50">
   <div class="mb-6 pb-6 border-b border-blue-100">
    <h2 class="text-2xl font-bold text-blue-600 mb-3">{{ $complaint->judul }}</h2>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
     <div>
      <p class="text-sm text-gray-600">Siswa</p>
      <p class="font-medium mt-1 text-gray-900">{{ $complaint->user->nama }}</p>
      <p class="text-sm text-gray-600">NIS: {{ $complaint->user->nis }}</p>
     </div>
     
     <div>
      <p class="text-sm text-gray-600">Kategori</p>
      <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded mt-1">
       {{ ucfirst($complaint->kategori) }}
      </span>
     </div>

     <div>
      <p class="text-sm text-gray-600">Status</p>
      <span class="inline-block px-3 py-1 rounded text-sm font-semibold mt-1
       @if($complaint->status === 'pending') bg-yellow-100 text-yellow-800
       @elseif($complaint->status === 'diproses') bg-blue-100 text-blue-800
       @else bg-green-100 text-green-800
       @endif">
       {{ ucfirst($complaint->status) }}
      </span>
     </div>

     <div>
      <p class="text-sm text-gray-600">Tanggal</p>
      <p class="font-medium mt-1 text-gray-900">{{ $complaint->created_at->format('d M Y H:i') }}</p>
     </div>
    </div>
   </div>

   <!-- Deskripsi -->
   <div class="mb-6">
    <h3 class="text-lg font-semibold text-blue-600 mb-3">Deskripsi Pengaduan</h3>
    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $complaint->deskripsi }}</p>
   </div>

   <!-- Lampiran Gambar -->
   @if($complaint->image)
    <div class="mb-6">
     <h3 class="text-lg font-semibold text-blue-600 mb-3">Lampiran Gambar</h3>
     <div class="border border-blue-100 rounded-lg overflow-hidden inline-block">
      <img src="{{ asset('storage/' . $complaint->image) }}" alt="Lampiran" 
       class="max-h-64 cursor-pointer hover:opacity-90 "
       onclick="document.getElementById('lightbox').classList.remove('hidden')">
     </div>
    </div>

    <!-- Lightbox -->
    <div id="lightbox" class="hidden fixed inset-0 bg-black/80 z-[100] flex items-center justify-center p-4" onclick="this.classList.add('hidden')">
     <img src="{{ asset('storage/' . $complaint->image) }}" alt="Lampiran" class="max-w-full max-h-full rounded-lg border">
    </div>
   @endif
  </div>

  <!-- Update Status -->
  <div class="bg-white rounded shadow-md p-8 mb-6 border border-blue-50">
   <h3 class="text-lg font-semibold text-blue-600 mb-4">Update Status</h3>
   <form method="POST" action="/admin/complaints/{{ $complaint->id }}/status" class="flex gap-3">
    @csrf
    @method('PATCH')
    
    <select name="status" required class="flex-1 p-3 border border-blue-200 rounded-lg focus:border-blue-600 focus:ring-2 focus:ring-blue-100 outline-none">
     <option value="pending" @selected($complaint->status === 'pending')>Pending</option>
     <option value="diproses" @selected($complaint->status === 'diproses')>Diproses</option>
     <option value="selesai" @selected($complaint->status === 'selesai')>Selesai</option>
    </select>
    
    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold ">
     Update Status
    </button>
   </form>
  </div>

  <!-- Feedback -->
  <div class="bg-white rounded shadow-md p-8 mb-6 border border-blue-50">
   <h3 class="text-lg font-semibold text-blue-600 mb-4">Feedback untuk Siswa</h3>
   
   @if($complaint->feedback)
    <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
     <p class="text-blue-600 leading-relaxed whitespace-pre-wrap">{{ $complaint->feedback }}</p>
    </div>
   @endif

   <form method="POST" action="/admin/complaints/{{ $complaint->id }}/feedback">
    @csrf
    @method('PATCH')
    
    <textarea name="feedback" required rows="5"
     placeholder="Tulis feedback untuk siswa..."
     class="w-full p-3 border border-blue-200 rounded-lg focus:border-blue-600 focus:ring-2 focus:ring-blue-100 outline-none ">{{ $complaint->feedback }}</textarea>
    
    <button type="submit" class="mt-3 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-semibold ">
     Kirim Feedback
    </button>
   </form>
  </div>

  <!-- Back -->
  <a href="/admin/complaints"
   class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-semibold">
   ← Kembali
  </a>
 </div>
</div>



@endsection
