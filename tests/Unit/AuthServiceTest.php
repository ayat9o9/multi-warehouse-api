<?php

namespace Tests\Unit\User;

use Tests\TestCase;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;

class AuthServiceTest extends TestCase
{
    use WithFaker;

    protected AuthService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(AuthService::class);
    }

    /** @test */
    // public function it_can_register_a_user()
    // {
    //     $data = [
    //         'name' => $this->faker->name,
    //         'email' => $this->faker->unique()->safeEmail,
    //         'password' => 'secret123',
    //     ];

    //     $user = $this->service->register($data);

    //     $this->assertInstanceOf(User::class, $user);
    //     $this->assertEquals($data['email'], $user->email);
    //     $this->assertTrue(Hash::check('secret123', $user->password));
    // }

    /** @test */
    public function it_can_login_a_user()
    {
        $password = 'secret123';

        $user = \App\Models\User::factory()->create([
            'password' => \Illuminate\Support\Facades\Hash::make($password),
        ]);

        $result = $this->service->login([
            'email' => $user->email,
            'password' => $password,
        ]);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('token', $result);
        $this->assertArrayHasKey('token_type', $result);
        $this->assertIsString($result['token']);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
