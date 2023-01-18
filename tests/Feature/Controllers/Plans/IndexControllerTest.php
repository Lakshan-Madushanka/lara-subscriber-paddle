<?php

it('it can render plans view', function () {
    \Laravel\Sanctum\Sanctum::actingAs(\App\Models\User::factory()->create());

    $response = \Pest\Laravel\get(route('plans.index'));

    $response->assertStatus(200);
    $response->assertSee('No plans exists');
});
