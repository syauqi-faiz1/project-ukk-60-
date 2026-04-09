<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="UTF-8">
 <title>Tambah Admin</title>
 @vite(['resources/css/app.css', 'resources/js/app.js'])
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-blue-600 from-blue-50 to-blue-100 min-h-screen flex items-center justify-center">

<form method="POST" action="/admin/register" class="bg-white p-8 rounded border w-full max-w-sm border border-blue-100">
 @csrf
 <div class="flex items-center justify-center mb-6">
  <div class="flex items-center justify-center w-12 h-12 bg-blue-600  rounded-lg">
   <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
   </svg>
  </div>
 </div>
 <h2 class="text-2xl font-bold mb-2 text-center text-blue-600">Tambah Admin Baru</h2>
 <p class="text-center text-gray-600 text-sm mb-6">Daftarkan administrator baru untuk sistem</p>

 <input type="text" name="username" placeholder="Username" required value="{{ old('username') }}"
  class="w-full mb-3 p-3 border border-blue-200 rounded-lg focus:border-blue-600 focus:ring-2 focus:ring-blue-100 outline-none @error('username') border-red-500 @enderror">
 @error('username')
  <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
 @enderror

 <input type="password" name="password" placeholder="Password" required
  class="w-full mb-3 p-3 border border-blue-200 rounded-lg focus:border-blue-600 focus:ring-2 focus:ring-blue-100 outline-none @error('password') border-red-500 @enderror">
 @error('password')
  <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
 @enderror

 <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required
  class="w-full mb-6 p-3 border border-blue-200 rounded-lg focus:border-blue-600 focus:ring-2 focus:ring-blue-100 outline-none ">

 <button type="submit"
  class="w-full bg-blue-600 text-white py-3 rounded-lg hover:from-blue-800 hover:to-blue-700 font-semibold shadow-md hover:shadow border">
  Tambah Admin
 </button>

 <a href="/admin/dashboard" class="block text-center mt-4 text-sm text-blue-600 hover:text-blue-600 hover:underline">← Kembali ke Dashboard</a>
</form>

@if(session('success'))
<script>
Swal.fire({
 icon: "success",
 title: "Admin Berhasil Ditambahkan",
 text: "{{ session('success') }}",
 confirmButtonColor: '#003d82'
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
 icon: "error",
 title: "Gagal Menambah Admin",
 text: "{{ session('error') }}",
 confirmButtonColor: '#003d82'
});
</script>
@endif

</body>
</html>
