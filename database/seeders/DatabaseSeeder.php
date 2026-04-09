<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    Admin::create([
      'username' => 'admin',
      'password' => Hash::make('123456'),
    ]);

    $this->call([
      ComplaintSeeder::class,
      KelasSeeder::class,
    ]);
  }
}
