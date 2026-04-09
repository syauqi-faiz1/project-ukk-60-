@extends('layouts.admin')

@section('content')

<div class="bg-blue-600 text-white p-6 shadow border">
 <h1 class="text-3xl font-bold">Kelola Kelas</h1>
 <p class="text-blue-100 mt-1">Tambah, edit, dan hapus kategori kelas siswa.</p>
</div>

<div class="p-6">
 @if(session('success'))
  <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg p-4 mb-6">
   {{ session('success') }}
  </div>
 @endif

 <div class="mb-6">
  <a href="{{ route('admin.kelas.create') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
   Tambah Kelas Baru
  </a>
 </div>

 <div class="bg-white rounded shadow-md overflow-hidden">
  @if($kelas->count())
   <table class="w-full">
    <thead class="bg-blue-50 border-b border-blue-200">
     <tr>
      <th class="px-6 py-3 text-left text-sm font-semibold text-blue-600">Nama Kelas</th>
      <th class="px-6 py-3 text-center text-sm font-semibold text-blue-600">Aksi</th>
     </tr>
    </thead>
    <tbody>
     @foreach($kelas as $item)
      <tr class="border-b hover:bg-blue-50">
       <td class="px-6 py-3 font-medium text-gray-900">{{ $item->nama }}</td>
       <td class="px-6 py-3 text-center">
        <a href="{{ route('admin.kelas.edit', $item) }}" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 font-semibold text-sm mr-2">
         Edit
        </a>
        <form action="{{ route('admin.kelas.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kelas ini?')">
         @csrf @method('DELETE')
         <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 font-semibold text-sm">
          Hapus
         </button>
        </form>
       </td>
      </tr>
     @endforeach
    </tbody>
   </table>
  @else
   <div class="p-10 text-center">
    <p class="text-gray-600 text-lg">Belum ada kelas yang ditambahkan</p>
   </div>
  @endif
 </div>
</div>

@endsection