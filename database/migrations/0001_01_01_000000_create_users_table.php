<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up() {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('nis')->unique();
      $table->string('nama');
      $table->string('email')->unique()->nullable();
      $table->string('password');
      $table->string('kelas')->nullable();
      $table->enum('role', ['siswa', 'admin'])->default('siswa');
      $table->enum('status', ['pending', 'approved'])->default('pending');
      $table->timestamp('approved_at')->nullable();
      $table->timestamps();
    });
  }

  public function down() {
    Schema::dropIfExists('users');
  }
};
