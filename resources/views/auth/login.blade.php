<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Portal Pengaduan</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white p-8 rounded shadow border w-full max-w-md">
    <h2 class="text-2xl font-bold text-center mb-6">Portal Pengaduan Siswa</h2>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-green-600" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Role Selection -->
      <div class="mb-6">
        <label class="block text-sm font-semibold text-gray-700 mb-2">Login Sebagai:</label>
        <div class="flex space-x-4">
          <label class="flex items-center space-x-2">
            <input type="radio" name="role_selector" value="siswa" checked class="text-blue-600 focus:ring-blue-500" onchange="updateLabel('NIS')">
            <span>Siswa</span>
          </label>
          <label class="flex items-center space-x-2">
            <input type="radio" name="role_selector" value="admin" class="text-blue-600 focus:ring-blue-500" onchange="updateLabel('Username')">
            <span>Admin</span>
          </label>
        </div>
      </div>

      <!-- NIS / Username -->
      <div class="mb-4">
        <label id="identifier-label" for="nis" class="block text-sm font-semibold text-gray-700 mb-1">NIS</label>
        <input id="nis" class="w-full p-2 border border-gray-300 rounded focus:border-blue-500 outline-none" type="text" name="nis" value="{{ old('nis') }}" required autofocus placeholder="Masukkan NIS">
        <x-input-error :messages="$errors->get('nis')" class="mt-2 text-red-500 text-sm" />
      </div>

      <!-- Password -->
      <div class="mb-6">
        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
        <input id="password" class="w-full p-2 border border-gray-300 rounded focus:border-blue-500 outline-none" type="password" name="password" required placeholder="Masukkan Password">
        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
      </div>

      <!-- Actions -->
      <div class="flex items-center justify-between mb-4">
        <label class="flex items-center space-x-2 text-sm text-gray-600">
          <input type="checkbox" name="remember" class="text-blue-600 border-gray-300 rounded">
          <span>Remember me</span>
        </label>
      </div>

      <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition">
        Log in
      </button>

      <div class="mt-4 text-center text-sm">
        <p>Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar sekarang</a></p>
      </div>
    </form>
  </div>

  <script>
    function updateLabel(text) {
      document.getElementById('identifier-label').innerText = text;
      document.getElementById('nis').placeholder = 'Masukkan ' + text;
    }
  </script>

</body>
</html>
