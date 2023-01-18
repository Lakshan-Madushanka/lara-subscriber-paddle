<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use function Pest\Laravel\get;

it('redirect to product page if not subscribed', function () {
    Sanctum::actingAs(User::factory()->create());

    $response = get('/dashboard');

    $response->assertRedirect();
});
