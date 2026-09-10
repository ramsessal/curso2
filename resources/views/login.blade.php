@extends('publico')

@section('titulo', 'Login')

@section('contenido')
    <div class="min-h-screen flex items-center justify-center bg-zinc-950 px-4">
        <div class="w-full max-w-md rounded-2xl border border-zinc-800 bg-zinc-900 p-8 shadow-2xl">
            <p class="text-zinc-200 text-lg font-semibold">Laravel</p>
            <h1 class="mt-2 text-4xl font-bold text-white">Sign in</h1>

            <form method="POST" action="{{ route('login.entrar') }}" class="mt-8 space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-zinc-200">Email address*</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                        class="mt-2 w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white shadow-sm outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-400/30">
                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-zinc-200">Password*</label>
                    <input id="password" type="password" name="password" required
                        class="mt-2 w-full rounded-xl border border-zinc-700 bg-zinc-800 px-4 py-3 text-white shadow-sm outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-400/30">
                    @error('password')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <label class="inline-flex items-center gap-2 text-zinc-300 text-sm">
                    <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-zinc-600 bg-zinc-800 text-amber-500 focus:ring-amber-400">
                    Remember me
                </label>

                <button type="submit"
                    class="w-full rounded-xl bg-amber-500 py-3 px-4 font-semibold text-zinc-900 transition hover:bg-amber-400">
                    Sign in
                </button>
            </form>
        </div>
    </div>
@endsection
