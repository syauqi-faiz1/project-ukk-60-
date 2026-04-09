<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateSiswaTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed admins table
        Admin::create([
            'username' => 'testadmin',
            'password' => bcrypt('123456'),
        ]);
    }

    public function test_create_siswa_with_valid_data()
    {
        // Login as admin first
        $admin = Admin::first();
        $response = $this->post('/login/admin', [
            'username' => 'testadmin',
            'password' => '123456'
        ]);

        $response->assertStatus(302); // Redirect after successful login

        // Now test create siswa endpoint
        $createResponse = $this->post('/admin/siswa-create', [
            'nama' => 'Test Siswa',
            'nis' => '001234',
            'email' => 'test@sekolah.sch.id',
            'password' => 'password123',
            'kelas' => 'X'
        ]);

        $this->assertDatabaseHas('users', [
            'nama' => 'Test Siswa',
            'nis' => '001234',
            'email' => 'test@sekolah.sch.id',
            'kelas' => 'X',
            'role' => 'siswa',
            'status' => 'approved'
        ]);
    }

    public function test_create_siswa_validation_required_fields()
    {
        // Login first
        $this->post('/login/admin', [
            'username' => 'testadmin',
            'password' => '123456'
        ]);

        $response = $this->post('/admin/siswa-create', [
            // Missing all required fields
        ]);

        $response->assertStatus(422); // Validation error
    }

    public function test_create_siswa_duplicate_nis()
    {
        // Create an existing user with NIS
        User::create([
            'nama' => 'Existing Siswa',
            'nis' => '001234',
            'email' => 'existing@sekolah.sch.id',
            'password' => bcrypt('123456'),
            'kelas' => 'X',
            'role' => 'siswa',
            'status' => 'approved'
        ]);

        // Login
        $this->post('/login/admin', [
            'username' => 'testadmin',
            'password' => '123456'
        ]);

        // Try to create with duplicate NIS
        $response = $this->post('/admin/siswa-create', [
            'nama' => 'New Siswa',
            'nis' => '001234', // Duplicate
            'email' => 'new@sekolah.sch.id',
            'password' => 'password123',
            'kelas' => 'X'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('nis');
    }

    public function test_create_siswa_invalid_kelas()
    {
        $this->post('/login/admin', [
            'username' => 'testadmin',
            'password' => '123456'
        ]);

        $response = $this->post('/admin/siswa-create', [
            'nama' => 'Test Siswa',
            'nis' => '001234',
            'email' => 'test@sekolah.sch.id',
            'password' => 'password123',
            'kelas' => 'XIII' // Invalid class
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('kelas');
    }

    public function test_create_siswa_invalid_email()
    {
        $this->post('/login/admin', [
            'username' => 'testadmin',
            'password' => '123456'
        ]);

        $response = $this->post('/admin/siswa-create', [
            'nama' => 'Test Siswa',
            'nis' => '001234',
            'email' => 'invalid-email', // Invalid
            'password' => 'password123',
            'kelas' => 'X'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }
}
