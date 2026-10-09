<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AvisosCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_la_ruta_create_responde_y_muestra_el_formulario(): void
    {
        $response = $this->get('/avisos/create');

        $response->assertStatus(200);
        $response->assertSee('Nuevo aviso');
    }
}
