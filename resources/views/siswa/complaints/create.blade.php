@extends('layouts.siswa')

@section('content')

   <div class="max-w-2xl mx-auto bg-white rounded-lg border border-gray-200 p-8 shadow-sm">
  <form method="POST" action="/siswa/complaints" enctype="multipart/form-data">
   @csrf

   <div class="mb-6">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
    <select name="kategori" required
     class="w-full p-3 border border-gray-300 rounded-lg focus:border-blue-600 focus:ring-2 focus:ring-blue-200 outline-none @error('kategori') border-red-500 @enderror">
     <option value="">-- Pilih Kategori --</option>
     @foreach($categories as $cat)
      <option value="{{ $cat->nama }}" {{ old('kategori') == $cat->nama ? 'selected' : '' }}>{{ ucfirst($cat->nama) }}</option>
     @endforeach
    </select>
    @error('kategori')
     <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
   </div>

   <div class="mb-6">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Pengaduan</label>
    <input type="text" name="judul" required value="{{ old('judul') }}"
     placeholder="Ringkas judul pengaduan Anda"
     class="w-full p-3 border border-gray-300 rounded-lg focus:border-blue-600 focus:ring-2 focus:ring-blue-200 outline-none @error('judul') border-red-500 @enderror">
    @error('judul')
     <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
   </div>

   <div class="mb-6">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Detail</label>
    <textarea name="deskripsi" required rows="6"
     placeholder="Jelaskan pengaduan Anda secara detail..."
     class="w-full p-3 border border-gray-300 rounded-lg focus:border-blue-600 focus:ring-2 focus:ring-blue-200 outline-none @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') }}</textarea>
    @error('deskripsi')
     <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
   </div>

   <div class="mb-6">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Lampiran Gambar (opsional)</label>
    <div id="dropZone" class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 cursor-pointer @error('image') border-red-500 @enderror">
     <input type="file" name="image" id="imageInput" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
     <div id="uploadPlaceholder">
      <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
       <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
      <p class="mt-2 text-sm text-gray-600">Klik atau drag & drop gambar di sini</p>
      <p class="mt-1 text-xs text-gray-400">PNG, JPG, GIF (maks. 2MB)</p>
     </div>
     <div id="imagePreview" class="hidden">
      <img id="previewImg" src="" alt="Preview" class="mx-auto max-h-48 rounded-lg">
      <button type="button" onclick="removeImage()" class="mt-2 text-sm text-red-500 hover:text-red-700">Hapus Gambar</button>
     </div>
    </div>
    @error('image')
     <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
   </div>

   <div class="flex gap-3">
    <button type="submit"
     class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-semibold">
     Kirim Pengaduan
    </button>
    <a href="/siswa/complaints"
     class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 font-semibold">
     Batal
    </a>
   </div>
  </div>

<script>
 // Image preview
 const imageInput = document.getElementById('imageInput');
 const dropZone = document.getElementById('dropZone');
 const uploadPlaceholder = document.getElementById('uploadPlaceholder');
 const imagePreview = document.getElementById('imagePreview');
 const previewImg = document.getElementById('previewImg');

 imageInput.addEventListener('change', function(e) {
  if (e.target.files && e.target.files[0]) {
   showPreview(e.target.files[0]);
  }
 });

 dropZone.addEventListener('dragover', function(e) {
  e.preventDefault();
  dropZone.classList.add('border-blue-500', 'bg-blue-50');
 });
 dropZone.addEventListener('dragleave', function(e) {
  e.preventDefault();
  dropZone.classList.remove('border-blue-500', 'bg-blue-50');
 });
 dropZone.addEventListener('drop', function(e) {
  e.preventDefault();
  dropZone.classList.remove('border-blue-500', 'bg-blue-50');
  if (e.dataTransfer.files && e.dataTransfer.files[0]) {
   imageInput.files = e.dataTransfer.files;
   showPreview(e.dataTransfer.files[0]);
  }
 });

 function showPreview(file) {
  if (!file.type.startsWith('image/')) return;
  const reader = new FileReader();
  reader.onload = function(e) {
   previewImg.src = e.target.result;
   uploadPlaceholder.classList.add('hidden');
   imagePreview.classList.remove('hidden');
  };
  reader.readAsDataURL(file);
 }

 function removeImage() {
  imageInput.value = '';
  previewImg.src = '';
  uploadPlaceholder.classList.remove('hidden');
  imagePreview.classList.add('hidden');
 }
</script>
@endsection
