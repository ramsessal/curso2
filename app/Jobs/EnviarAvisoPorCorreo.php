<?php

namespace App\Jobs;

use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class EnviarAvisoPorCorreo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Post $post)
    {
    }

    public function handle(): void
    {
        $usuarios = User::all();

        $this->post->destinatarios = $usuarios->count();
        $this->post->notificados = 0;
        $this->post->save();

        foreach ($usuarios as $usuario) {
            usleep(500_000);
            Log::info("Aviso {$this->post->id} enviado a {$usuario->email}");
            $this->post->increment('notificados');
        }
    }
}
