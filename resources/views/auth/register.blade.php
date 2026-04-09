<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar - Portal Pengaduan</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  <div class="bg-white p-8 rounded shadow border w-full max-w-md">
    <h2 class="text-2xl font-bold text-center mb-6">Pendaftaran Siswa Baru</h2>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <!-- Name -->
      <div class="mb-4">
        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
        <input id="nama" class="w-full p-2 border border-gray-300 rounded focus:border-blue-500 outline-none" type="text" name="nama" value="{{ old('nama') }}" required autofocus placeholder="Masukkan Nama Lengkap">
        <x-input-error :messages="$errors->get('nama')" class="mt-2 text-red-500 text-sm" />
      </div>

      <!-- NIS -->
      <div class="mb-4">
        <label for="nis" class="block text-sm font-semibold text-gray-700 mb-1">NIS (Nomor Induk Siswa)</label>
        <input id="nis" class="w-full p-2 border border-gray-300 rounded focus:border-blue-500 outline-none" type="text" name="nis" value="{{ old('nis') }}" required placeholder="Masukkan 10 digit NIS">
        <x-input-error :messages="$errors->get('nis')" class="mt-2 text-red-500 text-sm" />
      </div>

      <!-- Password -->
      <div class="mb-4">
        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
        <input id="password" class="w-full p-2 border border-gray-300 rounded focus:border-blue-500 outline-none" type="password" name="password" required>
        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
      </div>

      <!-- Confirm Password -->
      <div class="mb-6">
        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Password</label>
        <input id="password_confirmation" class="w-full p-2 border border-gray-300 rounded focus:border-blue-500 outline-none" type="password" name="password_confirmation" required>
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-sm" />
      </div>

      <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition">
        Daftar
      </button>

      <div class="mt-4 text-center text-sm">
        <p>Sudah terdaftar? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk disini</a></p>
      </div>
    </form>
  </div>

</body>
</html>
