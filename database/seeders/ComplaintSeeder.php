<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $siswa = User::first();

        if ($siswa) {
            Complaint::create([
                'user_id' => $siswa->id,
                'kategori' => 'fasilitas',
                'judul' => 'Meja dan kursi rusak di kelas',
                'deskripsi' => 'Banyak meja dan kursi di kelas kami yang rusak, terutama di bagian belakang kelas. Hal ini membuat siswa merasa tidak nyaman saat belajar.',
                'status' => 'diproses',
                'feedback' => 'Terima kasih atas pengaduan Anda. Tim kami sedang memperbaiki fasilitas tersebut dan akan selesai dalam 1 minggu.',
            ]);

            Complaint::create([
                'user_id' => $siswa->id,
                'kategori' => 'kebersihan',
                'judul' => 'Toilet sekolah kotor',
                'deskripsi' => 'Toilet di sekolah sangat kotor dan bau. Harap segera dibersihkan.',
                'status' => 'pending',
                'feedback' => null,
            ]);

            Complaint::create([
                'user_id' => $siswa->id,
                'kategori' => 'keamanan',
                'judul' => 'Pagar sekolah ada yang rusak',
                'deskripsi' => 'Bagian pagar di dekat pintu belakang sekolah ada yang rusak sehingga membuka celah keamanan.',
                'status' => 'selesai',
                'feedback' => 'Pagar sudah diperbaiki. Terima kasih atas laporan Anda.',
            ]);

            Complaint::create([
                'user_id' => $siswa->id,
                'kategori' => 'akademik',
                'judul' => 'Buku pelajaran kurang lengkap',
                'deskripsi' => 'Buku pelajaran untuk kelas kami masih kurang lengkap, beberapa siswa terpaksa berbagi 1 buku.',
                'status' => 'pending',
                'feedback' => null,
            ]);
        }
    }
}
