<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Admin Login - Portal Pengaduan</title>
 @vite(['resources/css/app.css', 'resources/js/app.js'])
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-blue-600  to-blue-950 min-h-screen flex items-center justify-center p-4">

 <div class="w-full max-w-sm">
  <!-- Card Container -->
  <div class="bg-white rounded-lg border-2 border-blue-900 shadow border overflow-hidden">
   <!-- Header -->
   <div class="bg-white border-b-2 border-blue-900 px-6 py-8 text-center">
    <h2 class="text-2xl font-bold text-blue-600 mb-1">Login Admin</h2>
    <p class="text-sm text-gray-600">Kelola Pengaduan Siswa</p>
   </div>

   <!-- Form -->
   <form method="POST" action="/login/admin" class="px-6 py-6">
    @csrf
    
    <!-- Username Field -->
    <div class="mb-4">
     <label class="block text-sm font-semibold text-gray-900 mb-2">Username</label>
     <input type="text" name="username" placeholder="Masukkan username" required
      class="w-full px-3 py-2 border border-gray-400 rounded focus:outline-none focus:border-blue-900 focus:ring-1 focus:ring-blue-900 ">
    </div>

    <!-- Password Field -->
    <div class="mb-5">
     <label class="block text-sm font-semibold text-gray-900 mb-2">Password</label>
     <input type="password" name="password" placeholder="Masukkan password" required
      class="w-full px-3 py-2 border border-gray-400 rounded focus:outline-none focus:border-blue-900 focus:ring-1 focus:ring-blue-900 ">
    </div>

    <!-- Submit Button -->
    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 font-semibold shadow hover:shadow-md">
     Masuk
    </button>
   </form>

   <!-- Footer -->
   <div class="px-6 py-4 bg-white border-t border-gray-300 text-center">
    <a href="/" class="text-blue-600 hover:text-blue-700 font-medium text-sm ">← Kembali</a>
   </div>
  </div>

  <!-- Additional Info -->
  <p class="text-center text-blue-100 text-sm mt-8">© 2026 Portal Pengaduan. Semua hak dilindungi.</p>
 </div>

@if(session('error'))
<script>
Swal.fire({
 icon: "error",
 title: "Login Gagal",
 text: "{{ session('error') }}",
 confirmButtonColor: "#003d82"
});
</script>
@endif

</body>
</html>
