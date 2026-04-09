@extends('layouts.admin')

@section('content')

<!-- Header -->
<div class="bg-blue-600 text-white p-6 shadow border">
 <h1 class="text-3xl font-bold">Approval Akun Siswa</h1>
 <p class="text-blue-100 mt-1">Setujui akun siswa sebelum dapat menggunakan sistem</p>
</div>

<div class="p-6">

 <!-- Stats -->
 <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
  <div class="bg-white rounded-lg shadow p-4 border-l-4 border-blue-600">
   <div class="text-2xl font-bold text-blue-600">{{ $stats['total'] }}</div>
   <p class="text-sm text-gray-600 mt-1">Total Siswa</p>
  </div>
  <div class="bg-white rounded-lg shadow p-4 border-l-4 border-yellow-500">
   <div class="text-2xl font-bold text-yellow-500">{{ $stats['pending'] }}</div>
   <p class="text-sm text-gray-600 mt-1">Menunggu Approval</p>
  </div>
  <div class="bg-white rounded-lg shadow p-4 border-l-4 border-green-500">
   <div class="text-2xl font-bold text-green-500">{{ $stats['approved'] }}</div>
   <p class="text-sm text-gray-600 mt-1">Sudah Aktif</p>
  </div>
  <div class="bg-white rounded-lg shadow p-4 border-l-4 border-red-500">
   <div class="text-2xl font-bold text-red-500">{{ $stats['blocked'] ?? 0 }}</div>
   <p class="text-sm text-gray-600 mt-1">Ditolak</p>
  </div>
 </div>

 <!-- List Siswa -->
 <div class="bg-white rounded shadow-md overflow-hidden">
  @if($pendingSiswa->count())
   <table class="w-full">
    <thead class="bg-blue-50 border-b border-blue-200">
     <tr>
      <th class="px-6 py-3 text-left text-sm font-semibold text-blue-600">NIS</th>
      <th class="px-6 py-3 text-left text-sm font-semibold text-blue-600">Nama</th>
      <th class="px-6 py-3 text-left text-sm font-semibold text-blue-600">Status</th>
      <th class="px-6 py-3 text-center text-sm font-semibold text-blue-600">Aksi</th>
     </tr>
    </thead>
    <tbody>
     @foreach($pendingSiswa as $siswa)
      <tr class="border-b hover:bg-blue-50 ">
       <td class="px-6 py-3 font-medium text-gray-900">{{ $siswa->nis }}</td>
       <td class="px-6 py-3 font-medium text-gray-900">{{ $siswa->nama }}</td>
       <td class="px-6 py-3">
        <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded font-semibold">
         Pending
        </span>
       </td>
       <td class="px-6 py-3 text-center">
        <form action="/admin/siswa/{{ $siswa->id }}/approve" method="POST" class="inline">
         @csrf
         <button
          class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 font-semibold">
          Approve
         </button>
        </form>
       </td>
      </tr>
     @endforeach
    </tbody>
   </table>
  @else
   <div class="p-10 text-center">
    <p class="text-gray-600 text-lg">Tidak ada siswa yang menunggu persetujuan</p>
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
