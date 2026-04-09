<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Portal Pengaduan</title>
 @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

 <!-- Navbar -->
 <nav class="bg-blue-600 text-white p-4 shadow">
  <div class="container mx-auto flex justify-between items-center">
   <h1 class="text-xl font-bold">Portal Pengaduan Sekolah</h1>
   <div>
    <a href="/login" class="bg-white text-blue-600 px-4 py-2 rounded font-medium hover:bg-gray-100">Login</a>
   </div>
  </div>
 </nav>

 <!-- Content -->
 <main class="flex-grow container mx-auto p-8 flex flex-col items-center justify-center text-center">
  <h2 class="text-3xl font-bold text-gray-800 mb-4">Sampaikan Pengaduan dengan Mudah</h2>
  <p class="text-gray-600 mb-8 max-w-lg">Sistem informasi pengelolaan pengaduan untuk sekolah. Fitur sederhana agar mudah dipelajari pada saat ujian UKK.</p>
  
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full max-w-2xl text-left">
   <div class="bg-white p-6 rounded shadow border">
    <h3 class="font-bold text-lg mb-2 text-blue-600">Untuk Siswa</h3>
    <p class="text-sm text-gray-600">Siswa dapat melaporkan kejadian dan memantau status pengaduan.</p>
   </div>
   <div class="bg-white p-6 rounded shadow border">
    <h3 class="font-bold text-lg mb-2 text-blue-600">Untuk Admin</h3>
    <p class="text-sm text-gray-600">Admin sekolah akan merespon dan menyelesaikan masalah tepat waktu.</p>
   </div>
  </div>
 </main>

 <!-- Footer -->
 <footer class="bg-gray-800 text-white text-center p-4 mt-auto">
  <p>&copy; 2026 Portal Pengaduan Siswa</p>
 </footer>

</body>
</html>
