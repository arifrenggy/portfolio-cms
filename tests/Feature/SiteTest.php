<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_homepage_loads_with_dynamic_content(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Kurniawan A. Renggy');
        $response->assertSee('Tentang Saya');
        $response->assertSee('Proyek Contoh Satu');
    }

    public function test_project_detail_loads(): void
    {
        $response = $this->get('/proyek/proyek-contoh-satu');

        $response->assertStatus(200);
        $response->assertSee('Proyek Contoh Satu');
    }

    public function test_guest_is_redirected_to_admin_login(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect();
    }

    public function test_admin_can_access_panel(): void
    {
        $user = User::factory()->create([
            'is_admin' => true,
        ]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_access_panel(): void
    {
        $user = User::factory()->create([
            'is_admin' => false,
        ]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(403);
    }
}
