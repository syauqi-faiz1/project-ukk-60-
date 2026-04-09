<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Siswa Panel</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex min-h-screen">

  <aside class="w-64 bg-blue-800 text-white min-h-screen p-4 flex-shrink-0">
    <h2 class="text-xl font-bold mb-6">Portal Siswa</h2>
    <nav class="flex flex-col space-y-2">
      <a href="/siswa/dashboard" class="p-2 hover:bg-blue-700 rounded">Dashboard</a>
      <a href="/siswa/complaints" class="p-2 hover:bg-blue-700 rounded">Pengaduan Saya</a>
      <a href="/siswa/complaints/create" class="p-2 hover:bg-blue-700 rounded text-yellow-300 font-bold">Buat Pengaduan</a>
      <form action="/logout" method="POST" class="mt-8">
        @csrf
        <button type="submit" class="w-full text-left p-2 text-white hover:bg-blue-700 rounded">Logout</button>
      </form>
    </nav>
  </aside>

  <main class="flex-1 p-8 overflow-y-auto">
    @yield('content')
  </main>

  @if(session('success'))
  <script>alert('{{ session("success") }}');</script>
  @endif
  @if(session('error'))
  <script>alert('{{ session("error") }}');</script>
  @endif

</body>
</html>
