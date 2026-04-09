@extends('layouts.admin')

@section('content')

   <div class="max-w-3xl mx-auto mb-8">
    <div class="bg-white rounded shadow-md p-6 border border-blue-50">
     <h3 class="text-lg font-semibold text-blue-600 mb-4">Tambah Kategori Baru</h3>
     <form method="POST" action="/admin/categories" class="flex gap-3">
      @csrf
      <input type="text" name="nama" required placeholder="Nama kategori..." value="{{ old('nama') }}"
       class="flex-1 p-3 border border-blue-200 rounded-lg focus:border-blue-600 focus:ring-2 focus:ring-blue-100 outline-none @error('nama') border-red-500 @enderror">
      <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold ">
       Tambah
      </button>
     </form>
     @error('nama')
      <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
     @enderror
    </div>
   </div>

   <!-- Category List -->
   <div class="max-w-3xl mx-auto">
    <div class="bg-white rounded shadow-md overflow-hidden border border-blue-50">
     <div class="bg-blue-50 border-b border-blue-200 px-6 py-4">
      <h3 class="text-lg font-semibold text-blue-600">Daftar Kategori ({{ $categories->count() }})</h3>
     </div>

     @if($categories->count() > 0)
      <table class="w-full">
       <thead class="bg-gray-50 border-b border-gray-200">
        <tr>
         <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 w-12">#</th>
         <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama Kategori</th>
         <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Dibuat</th>
         <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700 w-48">Aksi</th>
        </tr>
       </thead>
       <tbody>
        @foreach($categories as $index => $category)
         <tr class="border-b hover:bg-blue-50/50 " id="row-{{ $category->id }}">
          <td class="px-6 py-4 text-sm text-gray-600">{{ $index + 1 }}</td>
          <td class="px-6 py-4">
           <!-- Display Mode -->
           <span id="display-{{ $category->id }}" class="font-medium text-gray-900">{{ ucfirst($category->nama) }}</span>
           <!-- Edit Mode -->
           <form id="edit-form-{{ $category->id }}" method="POST" action="/admin/categories/{{ $category->id }}" class="hidden flex gap-2">
            @csrf
            @method('PUT')
            <input type="text" name="nama" value="{{ $category->nama }}" required
             class="flex-1 px-3 py-1 border border-blue-300 rounded-lg focus:border-blue-600 focus:ring-1 focus:ring-blue-200 outline-none text-sm">
            <button type="submit" class="text-xs bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 ">Simpan</button>
            <button type="button" onclick="cancelEdit({{ $category->id }})" class="text-xs bg-gray-400 text-white px-3 py-1 rounded-lg hover:bg-gray-500 ">Batal</button>
           </form>
          </td>
          <td class="px-6 py-4 text-sm text-gray-500">{{ $category->created_at->format('d M Y') }}</td>
          <td class="px-6 py-4 text-center">
           <div id="actions-{{ $category->id }}" class="flex justify-center gap-2">
            <button onclick="startEdit({{ $category->id }})" class="text-blue-600 hover:text-blue-700 text-sm font-semibold ">
             Edit
            </button>
            <form method="POST" action="/admin/categories/{{ $category->id }}" class="inline" onsubmit="return confirmDelete(event, '{{ ucfirst($category->nama) }}')">
             @csrf
             @method('DELETE')
             <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-semibold ">
              Hapus
             </button>
            </form>
           </div>
          </td>
         </tr>
        @endforeach
       </tbody>
      </table>
     @else
      <div class="p-8 text-center">
       <p class="text-gray-500 text-lg">Belum ada kategori</p>
       <p class="text-gray-400 text-sm mt-1">Tambahkan kategori baru menggunakan form di atas</p>
      </div>
     @endif
    </div>
   </div>

<script>
 function startEdit(id) {
  document.getElementById('display-' + id).classList.add('hidden');
  document.getElementById('edit-form-' + id).classList.remove('hidden');
  document.getElementById('actions-' + id).classList.add('hidden');
 }

 function cancelEdit(id) {
  document.getElementById('display-' + id).classList.remove('hidden');
  document.getElementById('edit-form-' + id).classList.add('hidden');
  document.getElementById('actions-' + id).classList.remove('hidden');
 }

 function confirmDelete(event, name) {
  event.preventDefault();
  if (confirm('Kategori "' + name + '" akan dihapus!')) {
      event.target.submit();
  }
  return false;
 }
</script>

@endsection
