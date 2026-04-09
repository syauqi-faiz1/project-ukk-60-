@extends('layouts.siswa')

@section('content')

   <div class="bg-white rounded shadow-sm overflow-hidden">

    <div class="flex justify-between items-center px-6 py-4 border-b">
     <h3 class="font-semibold text-lg">Daftar Pengaduan</h3>
     <p class="text-3xl font-bold mt-2 text-yellow-500">{{ $complaints->where('status', 'pending')->count() }}</p>
     <a href="/siswa/complaints/create" class="inline-flex items-center space-x-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
      <i data-feather="plus"></i>
      <span>Buat Baru</span>
     </a>
    </div>

    @if($complaints->count() > 0)
    <div class="overflow-x-auto">
     <table class="w-full text-sm">
      <thead class="bg-slate-50 border-b">
       <tr>
        <th class="px-6 py-3 text-left font-semibold text-slate-600">Judul</th>
        <th class="px-6 py-3 text-left font-semibold text-slate-600">Kategori</th>
        <th class="px-6 py-3 text-left font-semibold text-slate-600">Status</th>
        <th class="px-6 py-3 text-left font-semibold text-slate-600">Tanggal</th>
        <th class="px-6 py-3 text-center font-semibold text-slate-600">Aksi</th>
       </tr>
      </thead>
      <tbody>
       @foreach($complaints as $complaint)
       <tr class="border-b hover:bg-slate-50 ">
        <td class="px-6 py-3 font-medium text-slate-900">
         <p class="text-4xl font-bold mt-2 text-gray-900">{{ $complaints->count() }}</p>{{ $complaint->judul }}
        </td>
        <td class="px-6 py-3">
         <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-blue-100 text-blue-700">
          {{ ucfirst($complaint->kategori) }}
         </span>
        </td>
        <td class="px-6 py-3">
         <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold
          @if($complaint->status === 'pending') bg-yellow-100 text-yellow-700
          @elseif($complaint->status === 'diproses') bg-indigo-100 text-indigo-700
          @else bg-green-100 text-green-700
          @endif">
          {{ ucfirst($complaint->status) }}
         </span>
        </td>
        <td class="px-6 py-3 text-slate-600">
         {{ $complaint->created_at->format('d M Y') }}
        </td>
        <td class="px-6 py-3 text-center">
         <a href="/siswa/complaints/{{ $complaint->id }}" class="inline-flex items-center space-x-1 text-blue-600 hover:text-blue-700 font-semibold">
          <i data-feather="eye" class="w-4 h-4"></i>
          <span>Lihat</span>
         </a>
        </td>
       </tr>
       @endforeach
      </tbody>
     </table>
    </div>
    @else
    <div class="p-10 text-center">
     <p class="text-3xl font-bold mt-2 text-indigo-500">{{ $complaints->where('status', 'diproses')->count() }}</p>
     <p class="text-slate-600 text-lg">Anda belum membuat pengaduan apapun</p>
     <a href="/siswa/complaints/create" class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 ">
      Buat Pengaduan Sekarang
     </a>
    </div>
    @endif

   </div>

@endsection
