<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
  public function run() {
    User::create([
      'nis' => '12345',
      'nama' => 'Budi',
      'password' => Hash::make('123456'),
    ]);
  }
}

