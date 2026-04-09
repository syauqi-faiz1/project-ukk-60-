@extends('layouts.siswa')

@section('content')

   <div class="max-w-3xl mx-auto bg-white rounded-lg border border-gray-200 p-8 shadow-sm">
  <!-- Header -->
  <div class="mb-6 pb-6 border-b">
   <h2 class="text-2xl font-bold text-gray-900 mb-3">{{ $complaint->judul }}</h2>
   
   <div class="flex gap-4 flex-wrap">
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
     <p class="text-sm text-gray-600">Tanggal Dibuat</p>
     <p class="font-medium mt-1">{{ $complaint->created_at->format('d M Y H:i') }}</p>
    </div>
   </div>
  </div>

  <!-- Deskripsi -->
  <div class="mb-6">
   <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi</h3>
   <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $complaint->deskripsi }}</p>
  </div>

  <!-- Lampiran Gambar -->
  @if($complaint->image)
   <div class="mb-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-3">Lampiran Gambar</h3>
    <div class="border border-gray-200 rounded-lg overflow-hidden inline-block">
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

  <!-- Feedback dari Admin -->
  @if($complaint->feedback)
   <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
    <h3 class="text-lg font-semibold text-green-900 mb-3">Feedback dari Admin</h3>
    <p class="text-green-800 leading-relaxed whitespace-pre-wrap">{{ $complaint->feedback }}</p>
   </div>
  @else
   <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <p class="text-gray-600">Admin belum memberikan feedback</p>
   </div>
  @endif

  <!-- Actions -->
  <div class="flex gap-3">
   <a href="/siswa/complaints"
    class="inline-block bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 font-semibold">
    ← Kembali
   </a>
  </div>
 </div>

@endsection
