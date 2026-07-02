<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $this->seed();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Sewa Motor Jadi');
    }

    public function test_catalog_and_motor_detail_pages_render(): void
    {
        $this->seed();

        $this->get('/cari-motor')->assertOk()->assertSee('Daftar Motor');
        $this->get('/cari-motor/honda-vario-125')->assertOk()->assertSee('Honda Vario 125');
    }

    public function test_user_can_register_and_create_booking(): void
    {
        $this->seed();

        $this->post('/register', [
            'name' => 'Rizky Demo',
            'email' => 'rizky@example.test',
            'phone' => '08111111111',
            'password' => 'Password123',
            'password_confirmation' => 'Password123',
        ])->assertRedirect('/cari-motor');

        $this->post('/bookings/honda-vario-125', [
            'start_date' => now()->addDay()->toDateString(),
            'end_date' => now()->addDays(3)->toDateString(),
            'pickup_location_id' => 1,
            'terms' => '1',
        ])->assertRedirect();
    }
}
