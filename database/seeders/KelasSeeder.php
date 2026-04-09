<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Kelas::create(['nama' => 'X']);
        \App\Models\Kelas::create(['nama' => 'XI']);
        \App\Models\Kelas::create(['nama' => 'XII']);
    }
}
