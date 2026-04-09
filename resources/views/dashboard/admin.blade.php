@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-bold mb-4">Selamat Datang, {{ auth()->user()->nama ?? 'Admin' }}</h1>

<div class="grid grid-cols-4 gap-4 mb-8">
  <div class="bg-white p-4 rounded shadow border">
    <h3 class="text-gray-500">Total Pengaduan</h3>
    <p class="text-2xl font-bold">{{ \App\Models\Complaint::count() }}</p>
  </div>
  <div class="bg-white p-4 rounded shadow border border-red-200">
    <h3 class="text-red-500">Pending</h3>
    <p class="text-2xl font-bold">{{ \App\Models\Complaint::where('status', 'pending')->count() }}</p>
  </div>
  <div class="bg-white p-4 rounded shadow border border-yellow-200">
    <h3 class="text-yellow-500">Diproses</h3>
    <p class="text-2xl font-bold">{{ \App\Models\Complaint::where('status', 'diproses')->count() }}</p>
  </div>
  <div class="bg-white p-4 rounded shadow border border-green-200">
    <h3 class="text-green-500">Selesai</h3>
    <p class="text-2xl font-bold">{{ \App\Models\Complaint::where('status', 'selesai')->count() }}</p>
  </div>
</div>
@endsection
