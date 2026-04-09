<!DOCTYPE html>
<html lang="id">
<head>
 <meta charset="UTF-8">
 <title>Akses Ditolak</title>
 @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-blue-600 from-red-50 to-red-100 min-h-screen flex items-center justify-center">

<div class="max-w-md mx-auto bg-white rounded shadow border p-8 text-center border border-red-200">
 <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-6 text-4xl">
  X
 </div>
 <h1 class="text-2xl font-bold text-gray-900 mb-4">Akses Terbatas</h1>
 <p class="text-gray-600 mb-6 leading-relaxed">
  Siswa tidak dapat mendaftar secara mandiri. Hubungi administrator sekolah untuk membuat akun Anda.
 </p>
 <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
  <p class="text-sm text-blue-600 font-semibold mb-2">Hubungi Admin Sekolah:</p>
  <p class="text-sm text-blue-700">Ketua TU atau Operator Sekolah</p>
 </div>
 <a href="/" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 ">
  ← Kembali ke Beranda
 </a>
</div>

</body>
</html>
