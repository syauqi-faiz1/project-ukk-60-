@extends('layouts.admin')

@section('content')

<div class="bg-blue-600 text-white p-6 shadow border">
 <h1 class="text-3xl font-bold">Kelola Pengaduan</h1>
 <p class="text-blue-100 mt-1">Kelola semua pengaduan dari siswa</p>
  <form method="GET" action="/admin/complaints" class="flex flex-wrap gap-4">
   <div class="flex-1 min-w-[200px]">
    <label class="block text-sm font-semibold text-white mb-2">Status</label>
    <select name="status" class="w-full p-2 border border-blue-300 rounded-lg bg-white text-black focus:border-blue-600 focus:ring-2 focus:ring-blue-300 outline-none">
     <option value="">-- Semua Status --</option>
     <option value="pending" @selected(request('status') === 'pending')>Pending</option>
     <option value="diproses" @selected(request('status') === 'diproses')>Diproses</option>
     <option value="selesai" @selected(request('status') === 'selesai')>Selesai</option>
    </select>
   </div>

   <div class="flex-1 min-w-[200px]">
    <label class="block text-sm font-semibold text-white mb-2">Kategori</label>
    <select name="kategori" class="w-full p-2 border border-blue-300 rounded-lg bg-white text-black focus:border-blue-600 focus:ring-2 focus:ring-blue-300 outline-none">
     <option value="">-- Semua Kategori --</option>
     @foreach($kategoriList as $kat)
      <option value="{{ $kat }}" @selected(request('kategori') === $kat)>{{ ucfirst($kat) }}</option>
     @endforeach
    </select>
   </div>

   <div class="flex-1 min-w-[200px]">
    <label class="block text-sm font-semibold text-white mb-2">Urutkan</label>
    <select name="order" class="w-full p-2 border border-blue-300 rounded-lg bg-white text-black focus:border-blue-600 focus:ring-2 focus:ring-blue-300 outline-none">
     <option value="terbaru" @selected(request('order') !== 'terlama')>Terbaru</option>
     <option value="terlama" @selected(request('order') === 'terlama')>Terlama</option>
    </select>
   </div>

   <div class="flex items-end gap-2">
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-semibold ">
     Filter
    </button>
    <a href="/admin/complaints" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 ">
     Reset
    </a>
   </div>
  </form>
 </div>

 <!-- List Pengaduan -->
 <div class="bg-white rounded shadow-md overflow-hidden">
  @if($complaints->count() > 0)
   <table class="w-full">
    <thead class="bg-blue-50 border-b border-blue-200">
     <tr>
      <th class="px-6 py-3 text-left text-sm font-semibold text-blue-600">Siswa</th>
      <th class="px-6 py-3 text-left text-sm font-semibold text-blue-600">Judul</th>
      <th class="px-6 py-3 text-left text-sm font-semibold text-blue-600">Kategori</th>
      <th class="px-6 py-3 text-left text-sm font-semibold text-blue-600">Status</th>
      <th class="px-6 py-3 text-left text-sm font-semibold text-blue-600">Tanggal</th>
      <th class="px-6 py-3 text-center text-sm font-semibold text-blue-600">Aksi</th>
     </tr>
    </thead>
    <tbody>
     @foreach($complaints as $complaint)
      <tr class="border-b hover:bg-blue-50 ">
       <td class="px-6 py-3">
        <p class="font-medium text-gray-900">{{ $complaint->user->nama }}</p>
       </td>
       <td class="px-6 py-3">
        <p class="font-medium text-gray-900">{{ $complaint->judul }}</p>
       </td>
       <td class="px-6 py-3">
        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
         {{ ucfirst($complaint->kategori) }}
        </span>
       </td>
       <td class="px-6 py-3">
        <span class="inline-block px-2 py-1 rounded text-xs font-semibold
         @if($complaint->status === 'pending') bg-yellow-100 text-yellow-800
         @elseif($complaint->status === 'diproses') bg-blue-100 text-blue-800
         @else bg-green-100 text-green-800
         @endif">
         {{ ucfirst($complaint->status) }}
        </span>
       </td>
       <td class="px-6 py-3 text-sm text-gray-600">
        {{ $complaint->created_at->format('d M Y') }}
       </td>
       <td class="px-6 py-3 text-center">
        <a href="/admin/complaints/{{ $complaint->id }}"
         class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
         Lihat Detail
        </a>
       </td>
      </tr>
     @endforeach
    </tbody>
   </table>
  @else
   <div class="p-8 text-center">
    <p class="text-gray-600 text-lg">Tidak ada pengaduan yang sesuai filter</p>
   </div>
  @endif
 </div>

 <!-- Back Button -->
 <div class="mt-6">
  <a href="/admin/dashboard"
   class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-semibold">
   ← Kembali ke Dashboard
  </a>
 </div>
</div>



@endsection
