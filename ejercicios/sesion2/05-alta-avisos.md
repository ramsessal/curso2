# Ejercicio 5 · El alta de avisos: tu formulario cobra vida (~30 min, en la tarea)

El formulario del Ejercicio 1 es decorativo: se ve bien pero no guarda nada. Aquí el blog completa el ciclo: una página de **alta de avisos** que valida lo que llega y crea posts reales. Todo lo que necesitas ya vive en tu proyecto: el vocabulario de formularios del Ejercicio 1 y los modelos del Ejercicio 2.

> Requisitos: Ejercicio 1 (formulario estilizado) y nivel 1 del Ejercicio 2 (portada con BD). Es parte obligatoria de la tarea.

## Parte A · La página del formulario (10 min)

1. Ruta GET en `routes/web.php` (el formulario necesita las categorías reales para su `<select>`):
   ```php
   use App\Models\Categoria;

   Route::get('/avisos/crear', function () {
       return view('avisos.crear', ['categorias' => Categoria::orderBy('nombre')->get()]);
   });
   ```

2. Vista `resources/views/avisos/crear.blade.php`, con las mismas clases del Ejercicio 1:
   ```blade
   @extends('layouts.publico')

   @section('titulo', 'Nuevo aviso')

   @section('contenido')
       <form method="POST" action="/avisos" class="max-w-lg mx-auto p-8 bg-white rounded-lg shadow mt-8">
           @csrf

           <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
           <input name="titulo" value="{{ old('titulo') }}"
                  class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none">
           @error('titulo') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror

           <label class="block text-sm font-medium text-gray-700 mb-1 mt-4">Categoría</label>
           <select name="categoria_id"
                   class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none">
               <option value="">Elige una categoría...</option>
               @foreach ($categorias as $categoria)
                   <option value="{{ $categoria->id }}" @selected(old('categoria_id') == $categoria->id)>
                       {{ $categoria->nombre }}
                   </option>
               @endforeach
           </select>
           @error('categoria_id') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror

           <label class="block text-sm font-medium text-gray-700 mb-1 mt-4">Contenido</label>
           <textarea name="contenido" rows="4"
                     class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none">{{ old('contenido') }}</textarea>
           @error('contenido') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror

           <button class="w-full bg-blue-900 text-white font-semibold rounded-lg py-2 hover:bg-blue-800 transition mt-5">
               Publicar aviso
           </button>
       </form>
   @endsection
   ```

   Las tres piezas que hacen la diferencia con el formulario decorativo:
   - **`@csrf`**: token de seguridad que Laravel exige en todo POST; sin él, error `419 Page Expired`.
   - **`old('campo')`**: si la validación falla, el formulario regresa con lo que la persona ya había escrito.
   - **`@error('campo')`**: imprime el mensaje del validador; son las clases de estado de error del Ejercicio 1, ahora conectadas de verdad.

   ✅ **Checkpoint A:** `http://localhost:8000/avisos/crear` muestra el formulario y el `<select>` lista las categorías reales del seeder.

## Parte B · Guardar con validación (15 min)

3. Ruta POST en `routes/web.php`:
   ```php
   use Illuminate\Http\Request;

   Route::post('/avisos', function (Request $request) {
       $datos = $request->validate([
           'titulo' => ['required', 'max:120'],
           'contenido' => ['required'],
           'categoria_id' => ['required', 'exists:categorias,id'],
       ]);

       Post::create($datos);

       return redirect('/');
   });
   ```
   Qué hace `validate()`: si algo falla, regresa al formulario con los mensajes listos para `@error` y lo escrito en `old()`, y NO ejecuta lo demás; si pasa, te entrega solo los campos validados (por eso `$datos` va directo a `create`).

   ✅ **Checkpoint B:** enviar el formulario vacío te regresa con los mensajes en rojo y no crea nada; lleno, te manda a la portada y tu aviso aparece hasta arriba.

4. Estrena la puerta de entrada: un botón en el hero de la portada.
   ```blade
   <a href="/avisos/crear"
      class="inline-block mt-4 bg-white text-blue-950 font-semibold rounded-lg px-4 py-2 hover:bg-blue-100 transition">
       Nuevo aviso
   </a>
   ```

## 🔥 Desafío (si quieres ir más lejos)

- **Mensajes en español:** segundo argumento de `validate()`: `['titulo.required' => 'El título es obligatorio', 'categoria_id.exists' => 'Elige una categoría válida']`.
- **Mensaje de éxito:** `return redirect('/')->with('ok', 'Aviso publicado');` y en la portada: `@if (session('ok')) <p class="...">{{ session('ok') }}</p> @endif`.

## Problemas comunes

| Síntoma | Causa probable |
|---|---|
| `419 Page Expired` al enviar | Falta `@csrf` dentro del `<form>` |
| `Add [titulo] to fillable property` | El `$fillable` del modelo `Post` no incluye ese campo (Ejercicio 2, paso 3) |
| El `<select>` sale sin categorías | La ruta GET no manda `$categorias`, o no has corrido `php artisan migrate --seed` |
| Al fallar la validación se borra lo escrito | Faltan los `old()` en los inputs |
| `Post::create` guarda pero la portada no lo muestra | Revisa que la ruta `/` no filtre de más (con el nivel 2, `publicado` nace en `true` por el default de la migración) |
