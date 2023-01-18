<?php

it('redirect to login page if not authenticated', function () {
    $response = \Pest\Laravel\get('/');

    $response->assertRedirect();
    $response->assertSee('login');
});

it('can render home page for login user', function () {
    \Laravel\Sanctum\Sanctum::actingAs(\App\Models\User::factory()->create());

    $response = \Pest\Laravel\get('/');

    $response->assertOk();
    $response->assertSee('SUBSCRIBE');
});
