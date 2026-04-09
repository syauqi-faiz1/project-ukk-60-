@extends('layouts.admin')

@section('content')

<div class="bg-blue-600 text-white p-6 shadow border">
 <h1 class="text-3xl font-bold">Tambah Kelas</h1>
 <p class="text-blue-100 mt-1">Masukkan nama kelas baru.</p>
</div>

<div class="p-6">
 @if($errors->any())
  <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 mb-6">
   <ul class="list-disc pl-5">
    @foreach($errors->all() as $error)
     <li>{{ $error }}</li>
    @endforeach
   </ul>
  </div>
 @endif

 <div class="bg-white rounded-lg shadow p-6">
  <form action="{{ route('admin.kelas.store') }}" method="POST" class="max-w-md">
   @csrf

   <div class="mb-4">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kelas</label>
    <input name="nama" type="text" value="{{ old('nama') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
   </div>

   <div class="flex gap-3">
    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
     Simpan
    </button>
    <a href="{{ route('admin.kelas.index') }}" class="inline-block bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 font-semibold">
     Kembali
    </a>
   </div>
  </form>
 </div>
</div>

@endsection