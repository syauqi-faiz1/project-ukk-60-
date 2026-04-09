@extends('layouts.siswa')

@section('content')
<h1 class="text-2xl font-bold mb-4">Selamat Datang, {{ auth()->user()->nama ?? 'Siswa' }}</h1>

<div class="grid grid-cols-4 gap-4 mb-8">
  <div class="bg-white p-4 rounded shadow border">
    <h3 class="text-gray-500">Total</h3>
    <p class="text-2xl font-bold">{{ \App\Models\Complaint::where('user_id', auth()->id())->count() }}</p>
  </div>
  <div class="bg-white p-4 rounded shadow border border-orange-200">
    <h3 class="text-orange-500">Pending</h3>
    <p class="text-2xl font-bold">{{ \App\Models\Complaint::where('user_id', auth()->id())->where('status', 'pending')->count() }}</p>
  </div>
  <div class="bg-white p-4 rounded shadow border border-blue-200">
    <h3 class="text-blue-500">Diproses</h3>
    <p class="text-2xl font-bold">{{ \App\Models\Complaint::where('user_id', auth()->id())->where('status', 'diproses')->count() }}</p>
  </div>
  <div class="bg-white p-4 rounded shadow border border-green-200">
    <h3 class="text-green-500">Selesai</h3>
    <p class="text-2xl font-bold">{{ \App\Models\Complaint::where('user_id', auth()->id())->where('status', 'selesai')->count() }}</p>
  </div>
</div>
@endsection
