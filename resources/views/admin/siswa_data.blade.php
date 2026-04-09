@extends('layouts.admin')

@section('content')

<!-- Header -->
<div class="bg-blue-600 text-white p-6 shadow border">
 <h1 class="text-3xl font-bold">Data Siswa</h1>
 <p class="text-blue-100 mt-1">Kelola dan hapus akun siswa yang sudah ditambahkan</p>
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

 @if(session('success'))
  <div class="bg-green-50 border border-green-200 text-green-700 rounded-lg p-4 mb-6">
   {{ session('success') }}
  </div>
 @endif

 <div class="mb-6">
  <a href="{{ route('admin.users.create') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold">
   Tambah Akun Siswa Baru
  </a>
 </div>

 <!-- Search & Filter -->
 <div class="bg-white rounded-lg shadow p-4 mb-6">
  <div class="flex flex-col md:flex-row gap-4">
   <div class="flex-1">
    <input type="text" id="searchInput" placeholder="Cari nama atau NIS..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-900 focus:ring-1 focus:ring-blue-900">
   </div>
   <div class="flex gap-2">
    <select id="statusFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-900 focus:ring-1 focus:ring-blue-900">
     <option value="">Semua Status</option>
     <option value="pending">Pending</option>
     <option value="approved">Approved</option>
    </select>
    <select id="kelasFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-900 focus:ring-1 focus:ring-blue-900">
     <option value="">Semua Kelas</option>
     @foreach($kelasOptions as $kelas)
      <option value="{{ $kelas }}">{{ $kelas }}</option>
     @endforeach
    </select>
   </div>
  </div>
 </div>

 <!-- List Siswa -->
 <div class="bg-white rounded shadow-md overflow-hidden">
  @if($siswa->count())
   <div class="overflow-x-auto">
    <table class="w-full">
     <thead class="bg-blue-50 border-b border-blue-200">
      <tr>
       <th class="px-6 py-3 text-left text-sm font-semibold text-blue-600">NIS</th>
       <th class="px-6 py-3 text-left text-sm font-semibold text-blue-600">Nama Siswa</th>
       <th class="px-6 py-3 text-left text-sm font-semibold text-blue-600">Email</th>
       <th class="px-6 py-3 text-center text-sm font-semibold text-blue-600">Kelas</th>
       <th class="px-6 py-3 text-center text-sm font-semibold text-blue-600">Status</th>
       <th class="px-6 py-3 text-center text-sm font-semibold text-blue-600">Tanggal Dibuat</th>
       <th class="px-6 py-3 text-center text-sm font-semibold text-blue-600">Aksi</th>
      </tr>
     </thead>
     <tbody id="siswaTableBody">
      @foreach($siswa as $item)
       <tr class="border-b hover:bg-blue-50 siswa-row" data-nis="{{ $item->nis }}" data-nama="{{ $item->nama }}" data-status="{{ $item->status }}" data-kelas="{{ $item->kelas }}">
        <td class="px-6 py-3 font-medium text-gray-900">{{ $item->nis }}</td>
        <td class="px-6 py-3 font-medium text-gray-900">{{ $item->nama }}</td>
        <td class="px-6 py-3 text-gray-700">{{ $item->email }}</td>
        <td class="px-6 py-3 text-center">
         <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full font-semibold">
          Kelas {{ $item->kelas }}
         </span>
        </td>
        <td class="px-6 py-3 text-center">
         @if($item->status === 'approved')
          <span class="inline-block bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full font-semibold">
           Aktif
          </span>
         @else
          <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-3 py-1 rounded-full font-semibold">
           {{ ucfirst($item->status) }}
          </span>
         @endif
        </td>
        <td class="px-6 py-3 text-center text-sm text-gray-600">
         {{ $item->created_at->format('d/m/Y H:i') }}
        </td>
        <td class="px-6 py-3 text-center">
         <button onclick="deleteSiswa({{ $item->id }}, '{{ $item->nama }}')" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 font-semibold text-sm">
          Hapus
         </button>
        </td>
       </tr>
      @endforeach
     </tbody>
    </table>
   </div>
  @else
   <div class="p-10 text-center">
    <p class="text-gray-600 text-lg">Belum ada siswa yang ditambahkan</p>
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

<script>
 // Search & Filter
 const searchInput = document.getElementById('searchInput');
 const statusFilter = document.getElementById('statusFilter');
 const kelasFilter = document.getElementById('kelasFilter');
 const siswaRows = document.querySelectorAll('.siswa-row');

 function filterTable() {
  const searchValue = searchInput.value.toLowerCase();
  const statusValue = statusFilter.value;
  const kelasValue = kelasFilter.value;

  siswaRows.forEach(row => {
   const nis = row.getAttribute('data-nis').toLowerCase();
   const nama = row.getAttribute('data-nama').toLowerCase();
   const status = row.getAttribute('data-status');
   const kelas = row.getAttribute('data-kelas');

   const matchSearch = nis.includes(searchValue) || nama.includes(searchValue);
   const matchStatus = statusValue === '' || status === statusValue;
   const matchKelas = kelasValue === '' || kelas === kelasValue;

   if (matchSearch && matchStatus && matchKelas) {
    row.style.display = '';
   } else {
    row.style.display = 'none';
   }
  });
 }

 searchInput.addEventListener('keyup', filterTable);
 statusFilter.addEventListener('change', filterTable);
 kelasFilter.addEventListener('change', filterTable);

 // Delete Siswa
 function deleteSiswa(id, name) {
  Swal.fire({
   title: 'Hapus Akun Siswa?',
   html: `Anda akan menghapus akun siswa <strong>${name}</strong>. Tindakan ini tidak dapat dibatalkan!`,
   icon: 'warning',
   showCancelButton: true,
   confirmButtonColor: '#dc2626',
   cancelButtonColor: '#6b7280',
   confirmButtonText: 'Ya, Hapus',
   cancelButtonText: 'Batal'
  }).then(result => {
   if (result.isConfirmed) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    fetch(`/admin/siswa/${id}`, {
     method: 'DELETE',
     headers: {
      'X-CSRF-TOKEN': csrfToken,
      'Content-Type': 'application/json'
     }
    })
    .then(response => response.json())
    .then(data => {
     if (data.success) {
      Swal.fire('Berhasil!', data.message, 'success').then(() => {
       location.reload();
      });
     } else {
      Swal.fire('Error!', data.message, 'error');
     }
    })
    .catch(error => {
     Swal.fire('Error!', 'Terjadi kesalahan: ' + error.message, 'error');
    });
   }
  });
 }
</script>

@endsection
