<?php

namespace Database\Seeders;

use App\Models\ComplaintCategory;
use Illuminate\Database\Seeder;

class ComplaintCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Fasilitas', 'Akademik', 'Kebersihan', 'Keamanan', 'Lainnya'];

        foreach ($categories as $name) {
            ComplaintCategory::firstOrCreate(['nama' => strtolower($name)]);
        }
    }
}
