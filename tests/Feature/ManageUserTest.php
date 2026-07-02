<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ManageUserTest extends TestCase
{
    /** @test */
    public function test_can_display_login_page()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('login');
    }

    /** @test */
    public function test_can_display_register_form()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertViewIs('Daftar.index');
    }

    /** @test */
    public function test_user_can_be_registered()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password123',
        ];

        $response = $this->post(route('post.register'), $data);
        $response->dump();
        $response->assertRedirect();
        $this->assertDatabaseHas('users', ['email' => 'johndoe@example.com']);
    }

    /** @test */
    public function test_can_display_edit_user_form()
    {
        $user = User::factory()->create();

        $this->actingAs($user); // Simulasi login

        $response = $this->get(route('profile.edit')); // Sesuaikan dengan nama route yang tersedia

        $response->assertStatus(200);
        $response->assertViewIs('pages.user.editprofil'); // Sesuaikan dengan nama view di controller
        $response->assertViewHas('user', $user);
    }

    /** @test */
    public function test_user_can_be_updated()
    {
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user); // Login sebagai user yang ingin diupdate

        $data = [
            'username' => 'Updated Name',
            'email' => 'updated.email@example.com',
            'nohp' => '08123456789',
            'keahlian' => 'Backend Developer',
            'deskripsi' => 'Updated profile description',
            'password' => '', // Tidak mengubah password
            'password_confirmation' => '', // Harus disediakan walaupun kosong
        ];

        $response = $this->post(route('profile.update'), $data);

        $response->assertRedirect(); // Controller redirect back
        $response->assertSessionHas('success', 'Profil berhasil diperbarui.');

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'email' => 'updated.email@example.com',
            'nohp' => '08123456789',
            'keahlian' => 'Backend Developer',
        ]);
    }

    /** @test */
    public function test_user_can_be_deleted()
    {
        $user = User::factory()->create();

        $response = $this->delete(route('pengguna.suspendu', $user));

        // ⚠️ Hati-hati: jika route delete user mengarah ke halaman lain, sesuaikan di sini
        $response->assertRedirect(); // bisa tambahkan route tujuan jika pasti
        $response->assertSessionHas('message', 'User deleted successfully');

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /** @test */
    public function test_home_page_loads_successfully()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSeeText('MASUK AKUN.');
    }

    /** @test */
    public function test_debug_create_user_and_dump_db()
    {
        $data = [
            'nama' => 'John Doe',
            'email' => 'john@example.com',
            'nohp' => '123',
            'password' => 'password123',
        ];

        $this->post(route('register'), $data);

        $users = DB::table('users')->get();
        dump($users);
    }
}
