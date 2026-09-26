<?php

use App\Models\Categoria;
use App\Models\Post;
use App\Models\Aviso\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('el listado trae solo los avisos publicados', function () {
    Aviso::factory()->count(3)->create(['publicado' => true]);
    Aviso::factory()->create(['publicado' => false]);

    $this->getJson('/api/avisos')
        ->assertStatus(200)
        ->assertJsonCount(3, 'data');
});
