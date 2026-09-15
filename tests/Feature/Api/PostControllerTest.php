<?php

namespace Tests\Feature\Api;

use App\Models\Categoria;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_editor_puede_crear_un_aviso(): void
    {
        $usuario = User::factory()->create(['rol' => 'editor']);
        $categoria = Categoria::create(['nombre' => 'Capacitacion']);
        Sanctum::actingAs($usuario);

        $respuesta = $this->postJson('/api/avisos', [
            'titulo' => 'Capacitacion',
            'contenido' => 'Contenido del aviso',
            'categoria_id' => $categoria->id,
        ]);

        $respuesta->assertStatus(201);
        $this->assertDatabaseHas('posts', ['titulo' => 'Capacitacion']);
    }

    public function test_usuario_no_autorizado_no_puede_secuestrar_un_aviso(): void
    {
        $usuario = User::factory()->create(['rol' => 'editor']);
        $atacante = User::factory()->create(['rol' => 'editor']);
        $categoria = Categoria::create(['nombre' => 'Capacitacion']);
        $post = Post::create([
            'titulo' => 'Capacitacion',
            'contenido' => 'Contenido original',
            'categoria_id' => $categoria->id,
            'user_id' => $usuario->id,
        ]);
        $post->forceFill(['created_at' => now(), 'updated_at' => now()])->save();
        Sanctum::actingAs($atacante);

        $respuesta = $this->putJson("/api/avisos/{$post->id}", [
            'titulo' => 'Secuestrado',
            'contenido' => 'Contenido actualizado',
            'categoria_id' => $categoria->id,
            'user_id' => $atacante->id,
        ]);

        $respuesta->assertForbidden();
        $this->assertDatabaseHas('posts', ['titulo' => 'Capacitacion']);
        $this->assertNotSame('Secuestrado', $post->fresh()->titulo);
    }
}