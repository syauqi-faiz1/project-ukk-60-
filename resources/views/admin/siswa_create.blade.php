@extends('layouts.admin')

@section('content')

<div class="bg-blue-600 text-white p-6 shadow border">
 <h1 class="text-3xl font-bold">Tambah Akun Siswa</h1>
 <p class="text-blue-100 mt-1">Masukkan data siswa baru untuk membuat akun.</p>
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
  <form action="{{ route('admin.users.store') }}" method="POST" class="grid gap-4 md:grid-cols-2">
   @csrf

   <div>
    <label class="block text-sm font-semibold text-gray-700 mb-2">NIS</label>
    <input name="nis" type="text" value="{{ old('nis') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
   </div>

   <div>
    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama</label>
    <input name="nama" type="text" value="{{ old('nama') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
   </div>

   <div>
    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
    <input name="email" type="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
   </div>

   <div>
    <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
    <input name="password" type="password" required class="w-full px-4 py-2 border border-gray-300 rounded-lg" />
   </div>

   <div>
    <label class="block text-sm font-semibold text-gray-700 mb-2">Kelas</label>
    <select name="kelas" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
     <option value="">Pilih Kelas</option>
     @foreach($kelasOptions as $kelas)
      <option value="{{ $kelas }}" {{ old('kelas') == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
     @endforeach
    </select>
   </div>

   <div class="md:col-span-2 flex flex-col gap-3 sm:flex-row sm:items-center">
    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
     Simpan Akun
    </button>
    <a href="{{ route('admin.users.data') }}" class="inline-block bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 font-semibold">
     Kembali ke Data Siswa
    </a>
   </div>
  </form>
 </div>
</div>

@endsection
